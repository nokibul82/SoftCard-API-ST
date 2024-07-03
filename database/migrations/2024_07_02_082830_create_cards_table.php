<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('design',30);
            $table->string('profile_photo')->nullable();
            $table->string('color',30);
            $table->string('logo')->nullable();
            $table->string('badge')->nullable();
            $table->string('card_name',30)->nullable();
            $table->string('prefix',30)->nullable();
            $table->string('first_name',30)->nullable();
            $table->string('middle_name',30)->nullable();
            $table->string('last_name',30)->nullable();
            $table->string('suffix',30)->nullable();
            $table->string('accreditation',30)->nullable();
            $table->string('preferred_name',30)->nullable();
            $table->string('maiden_name',30)->nullable();
            $table->string('pronouns',30)->nullable();
            $table->string('title',30)->nullable();
            $table->string('department',30)->nullable();
            $table->string('company',30)->nullable();
            $table->text('headline')->nullable();
            $table->string('website_text',30)->nullable();
            $table->string('website_link',30)->nullable();
            $table->string('link_text',30)->nullable();
            $table->string('link_link',30)->nullable();
            $table->string('instagram_text',30)->nullable();
            $table->string('instagram_link',30)->nullable();
            $table->string('applemusic_link',30)->nullable();
            $table->string('applemusic_text',30)->nullable();
            $table->string('behance_link',30)->nullable();
            $table->string('behance_text',30)->nullable();
            $table->string('bookings_link',30)->nullable();
            $table->string('bookings_text',30)->nullable();
            $table->string('brightcove_link',30)->nullable();
            $table->string('brightcove_text',30)->nullable();
            $table->string('calendly_link',30)->nullable();
            $table->string('calendly_text',30)->nullable();
            $table->string('cashapp_link',30)->nullable();
            $table->string('cashapp_text',30)->nullable();
            $table->string('discord_link',30)->nullable();
            $table->string('discord_text',30)->nullable();
            $table->string('dribbble_link',30)->nullable();
            $table->string('dribbble_text',30)->nullable();
            $table->string('facebook_link',30)->nullable();
            $table->string('facebook_text',30)->nullable();
            $table->string('github_link',30)->nullable();
            $table->string('github_text',30)->nullable();
            $table->string('line_link',30)->nullable();
            $table->string('line_text',30)->nullable();
            $table->string('linkedin_link',30)->nullable();
            $table->string('linkedin_text',30)->nullable();
            $table->string('meet_link',30)->nullable();
            $table->string('meet_text',30)->nullable();
            $table->string('nintendo_link',30)->nullable();
            $table->string('nintendo_text',30)->nullable();
            $table->string('patreon_link',30)->nullable();
            $table->string('patreon_text',5300)->nullable();
            $table->string('paypal_link',30)->nullable();
            $table->string('paypal_text',30)->nullable();
            $table->string('pinterest_link',30)->nullable();
            $table->string('pinterest_text',30)->nullable();
            $table->string('psn_link',30)->nullable();
            $table->string('psn_text',30)->nullable();
            $table->string('signal_link',30)->nullable();
            $table->string('signal_text',30)->nullable();
            $table->string('skype_link',30)->nullable();
            $table->string('skype_text',30)->nullable();
            $table->string('snapchat_link',30)->nullable();
            $table->string('snapchat_text',30)->nullable();
//            $table->string('soundcloud_link',30)->nullable();
//            $table->string('soundcloud_text',30)->nullable();
//            $table->string('spotify_link',30)->nullable();
//            $table->string('spotify_text',30)->nullable();
//            $table->string('teams_link',30)->nullable();
//            $table->string('teams_text',30)->nullable();
//            $table->string('telegram_link',30)->nullable();
//            $table->string('telegram_text',30)->nullable();
//            $table->string('tiktok_link',30)->nullable();
//            $table->string('tiktok_text',30)->nullable();
//            $table->string('twitch_link',30)->nullable();
//            $table->string('twitch_text',30)->nullable();
//            $table->string('venmo_link',30)->nullable();
//            $table->string('venmo_text',30)->nullable();
//            $table->string('vimeo_link',30)->nullable();
//            $table->string('vimeo_text',30)->nullable();
//            $table->string('webex_link',30)->nullable();
//            $table->string('webex_text',30)->nullable();
//            $table->string('wechat_link',30)->nullable();
//            $table->string('wechat_text',30)->nullable();
//            $table->string('whatsapp_link',30)->nullable();
//            $table->string('whatsapp_text',30)->nullable();
//            $table->string('x_link',30)->nullable();
//            $table->string('x_text',30)->nullable();
//            $table->string('xbox_link',30)->nullable();
//            $table->string('xbox_text',30)->nullable();
//            $table->string('xing_link',30)->nullable();
//            $table->string('xing_text',30)->nullable();
//            $table->string('yelp_link',30)->nullable();
//            $table->string('yelp_text',30)->nullable();
//            $table->string('youtube_link',30)->nullable();
//            $table->string('youtube_text',30)->nullable();
//            $table->string('zelle_link',30)->nullable();
//            $table->string('zelle_text',30)->nullable();
//            $table->string('zoom_link',30)->nullable();
//            $table->string('zoom_text',30)->nullable();
//            $table->string('address',30)->nullable();
//            $table->string('address_text',30)->nullable();
//            $table->string('date',30)->nullable();
//            $table->string('date_text',30)->nullable();
//            $table->string('email',30)->nullable();
//            $table->string('email_text',30)->nullable();
            $table->text('note')->nullable();
            $table->string('pdf')->nullable();
            $table->string('pdf_text',30)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('phone_text',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
