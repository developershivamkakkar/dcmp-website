<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });

        // Seed defaults from config/site.php so the table is usable immediately
        $defaults = [
            // General
            'site_name'          => config('site.name',      'DCM Presidency School'),
            'site_full_name'     => config('site.full_name', ''),
            'site_tagline'       => config('site.tagline',   ''),

            // Contact
            'address_line1'      => config('site.address.line1',   ''),
            'address_line2'      => config('site.address.line2',   ''),
            'address_city'       => config('site.address.city',    ''),
            'address_state'      => config('site.address.state',   ''),
            'address_country'    => config('site.address.country', ''),
            'address_postal'     => config('site.address.postal_code', ''),
            'phone'              => config('site.phone',            ''),
            'email_admissions'   => config('site.email_admissions', ''),
            'email_info'         => config('site.email_info',       ''),
            'whatsapp'           => config('site.whatsapp',         ''),

            // Social
            'social_facebook'    => config('site.social.facebook',  ''),
            'social_instagram'   => config('site.social.instagram', ''),
            'social_linkedin'    => config('site.social.linkedin',  ''),
            'social_twitter'     => config('site.social.twitter',   ''),
            'social_youtube'     => config('site.social.youtube',   ''),

            // Maps & Analytics
            'maps_embed'              => config('site.maps_embed',          ''),
            'google_analytics_id'     => config('site.google_analytics',    ''),
            'google_tag_manager_id'   => config('site.google_tag_manager',  ''),

            // SEO
            'meta_description'   => 'DCM Presidency School Ludhiana - Premier educational institution offering world-class education with focus on academic excellence and holistic development.',
            'meta_keywords'      => 'DCM Presidency School, School in Ludhiana, Best School Ludhiana, CBSE School Ludhiana, Top Schools Punjab, Quality Education, Holistic Development',

            // Admissions
            'admissions_url'     => config('site.admissions_url', ''),
            'brochure_url'       => config('site.brochure_url',   ''),
        ];

        foreach ($defaults as $key => $value) {
            DB::table('site_settings')->insert([
                'key'        => $key,
                'value'      => mb_convert_encoding((string) $value, 'UTF-8', 'UTF-8'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
