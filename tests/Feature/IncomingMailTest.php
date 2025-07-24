<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\IncomingMails;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomingMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_incoming_mail()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/surat-masuk', [
            'reference_number' => 'SM-001',
            'sender' => 'Dinas Pendidikan',
            'subject' => 'Undangan Rapat',
            'mail_date' => now(),
            'received_date' => now(),
            'file_path' => 'dummy.pdf',
            'created_by' => $admin->id,
        ]);

        $response->assertRedirect('/surat-masuk');
        $this->assertDatabaseHas('incoming_mails', ['mail_number' => 'SM-001']);
    }

    public function test_admin_can_view_incoming_mails()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        IncomingMails::factory()->count(3)->create();

        $response = $this->actingAs($admin)->get('/surat-masuk');

        $response->assertStatus(200);
        $response->assertSeeText('Surat Masuk');
    }
}
