<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPageSetting extends Model
{
    protected $fillable = [
        'hero_eyebrow',
        'hero_title',
        'hero_subtitle',
        'hero_image_path',
        'contact_heading',
        'notice',
        'phone',
        'fax',
        'public_email',
        'form_to_email',
        'address',
        'hours',
    ];

    public static function current(): self
    {
        return self::query()->firstOrCreate(['id' => 1], self::defaults());
    }

    public static function defaults(): array
    {
        return [
            'hero_eyebrow' => 'Contact\\Address\\Hours',
            'hero_title' => 'Contact Us',
            'hero_subtitle' => 'Please read these important notices before contacting the clinic.',
            'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
            'contact_heading' => 'Contact Us',
            'notice' => 'Please read these important notices before contacting the clinic: Call the clinic for scheduling. Please do not send any confidential patient information through this email. This email is only for general inquiries and is sent to a non-secure email server.',
            'phone' => '(541) 345-7532',
            'fax' => '(541) 345-6692',
            'public_email' => 'info@ptsclinic.com',
            'form_to_email' => config('contact.to_email'),
            'address' => "1310 Coburg Rd #5\nEugene, OR 97401",
            'hours' => "Monday through Friday: 8:00 am to 6:00 pm\nMonday through Thursday: last scheduled patient is at 5:45 pm\nFriday: Single patient schedule only-last scheduled patient is at 5:00 pm.",
        ];
    }

    public function heroImageUrl(): string
    {
        if (str_starts_with($this->hero_image_path, 'contact/')) {
            return asset('storage/'.$this->hero_image_path);
        }

        return asset($this->hero_image_path);
    }
}
