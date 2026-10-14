<?php

namespace Tests\Feature;

use App\Mail\ConsultationRequested;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactEnquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_enquiry_is_saved_and_notification_sent(): void
    {
        Mail::fake();
        $this->from('/contact')->post('/contact', [
            'enquiry_type' => 'contact', 'name' => 'Test Client',
            'contact' => 'client@example.com', 'message' => 'We need cooling equipment.',
        ])->assertRedirect('/contact')->assertSessionHas('success');
        $this->assertDatabaseHas('enquiries', ['contact' => 'client@example.com']);
        $this->assertDatabaseHas('email_logs', ['status' => 'sent']);
        Mail::assertSent(ConsultationRequested::class);
    }

    public function test_invalid_enquiry_does_not_save_or_claim_success(): void
    {
        Mail::fake();
        $this->from('/contact')->post('/contact', ['name' => 'Test', 'contact' => 'invalid'])
            ->assertSessionHasErrors(['contact', 'message'])->assertSessionMissing('success');
        $this->assertDatabaseCount('enquiries', 0);
        Mail::assertNothingSent();
    }

    public function test_email_failure_keeps_the_enquiry_and_records_failure(): void
    {
        Mail::shouldReceive('to')->once()->andThrow(new \RuntimeException('Test delivery failure'));
        $this->from('/contact')->post('/contact', ['name' => 'Test', 'contact' => '+8801828009393', 'message' => 'Please call me.'])
            ->assertSessionHas('success');
        $this->assertDatabaseCount('enquiries', 1);
        $this->assertDatabaseHas('email_logs', ['status' => 'failed']);
    }
}
