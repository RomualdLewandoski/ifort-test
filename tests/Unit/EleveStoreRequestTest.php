<?php

namespace Tests\Unit;

use App\Http\Requests\InscriptionRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class EleveStoreRequestTest extends TestCase
{
    use RefreshDatabase;

    private array $basePayload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->basePayload = [
            'nomPrenom' => 'Ano Nyme',
            'email' => 'romuald.lewandoski@yandex.com',
            'dateInscription' => Carbon::now()->format('Y-m-d H:i:s'),
            'estPrioritaire' => false,
            'statutInscription' => 'en_attente',
            'telephone' => '+33699592756',
        ];
    }

    /**
     * Test d'un payload valide
     */
    public function testValidPayload()
    {
        $validator = $this->makeValidator($this->basePayload);
        $this->assertTrue($validator->passes(), 'Payload OK');
    }

    /**
     * Test de rejet d'un payload invalide
     */
    public function testRejectInvalidPayload()
    {
        $this->basePayload['statutInscription'] = 'invalide';
        $validator = $this->makeValidator($this->basePayload);
        $this->assertFalse($validator->passes(), 'Payload en echec');

    }

    /**
     * Test format de téléphone valide
     */
    public function testTelephoneFormat()
    {
        $this->basePayload['telephone'] = '+33699592756';
        $validationInternational = $this->makeValidator($this->basePayload);
        $this->assertTrue($validationInternational->passes(), 'Format international OK');


        $this->basePayload['telephone'] = '0699592756';
        $validationNational = $this->makeValidator($this->basePayload);
        $this->assertTrue($validationNational->passes(), 'Format national OK');
    }

    /**
     * Test format de téléphone invalide
     */
    public function testInvalidTelephoneFormat()
    {
        foreach (['+33 6 99 59', 'abc', '123', '++33699592756', '33699592756', '3699592756'] as $badFormat) {
            $this->basePayload['telephone'] = $badFormat;
            $validator = $this->makeValidator($this->basePayload);
            $this->assertTrue($validator->fails(), "Ne devrait pas accepter: {$badFormat}");
            $this->assertArrayHasKey('telephone', $validator->errors()->toArray());
        }
    }

    /*
     * Récupération des règles de validation pour les champs de formulaire
     */
    private function rules(): array
    {
        return (new InscriptionRequest())->rules();
    }

    /*
     * Simulation de validation d'un $data avec les règles définie dans la FormRequest
     */
    private function makeValidator(array $data)
    {
        return Validator::make($data, $this->rules());
    }
}
