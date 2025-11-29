<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CelebrationRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CelebrationRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_celebration_registration_form()
    {
        $response = $this->get('/celebration');

        $response->assertStatus(200);
        $response->assertSee('OCECF 20th Celebration Registration');
    }

    /** @test */
    public function user_can_submit_celebration_registration()
    {
        Storage::fake('public');

        $response = $this->post('/celebration', [
            'name' => 'John Doe',
            'mobile_num' => '01812345678',
            'email' => 'john@example.com',
            'address' => '123 Main St, Dhaka',
            'emergency_contact' => '01987654321',
            'family_members' => 2,
            'children_count' => 1,
            'has_driver' => 1,
            'nid' => '1234567890',
            'bncc_batch' => '2015',
            'religion' => 'Islam',
            'has_children_under_five' => 1,
            'attend_wednesday_night' => 1,
            'payment_method' => 'Bkash',
            'transaction_number' => 'TRX123456789',
            'passport_photo' => UploadedFile::fake()->image('passport.jpg'),
            'transaction_screenshot' => UploadedFile::fake()->image('receipt.jpg'),
        ]);

        $response->assertRedirect();
        $this->assertCount(1, CelebrationRegistration::all());

        $registration = CelebrationRegistration::first();
        $this->assertEquals('John Doe', $registration->name);
        $this->assertEquals(2, $registration->family_members);
        $this->assertEquals(3500, $registration->amount); // 1500 + (2*1000) + 500
    }

    /** @test */
    public function celebration_registration_requires_validation()
    {
        $response = $this->post('/celebration', []);

        $response->assertSessionHasErrors([
            'name',
            'mobile_num',
            'email',
            'address',
            'emergency_contact',
            'family_members',
            'nid',
            'bncc_batch',
            'religion',
            'has_children_under_five',
            'attend_wednesday_night',
            'passport_photo',
            'payment_method',
            'transaction_number',
            'transaction_screenshot',
        ]);
    }
}