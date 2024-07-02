<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'design' => 'required|string',
            'color' =>'required|string',
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'badge' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'card_name' => 'required|string',
            'prefix' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'suffix' => 'required|string',
            'accreditation' => 'required|string',
            'preferred_name' => 'required|string',
            'maiden_name' => 'required|string',
            'pronouns' => 'required|string',
            'title' => 'required|string',
            'department' => 'required|string',
            'company' => 'required|string',
            'headline' => 'required|string',
            'address_link' => 'required|string',
            'address_text' => 'required|string',
            'applemusic_link' => 'required|string',
            'applemusic_text' => 'required|string',
            'behance_link' => 'required|string',
            'behance_text' => 'required|string',
            'bookings_link' => 'required|string',
            'bookings_text' => 'required|string',
            'brightcove_link' => 'required|string',
            'brightcove_text' => 'required|string',
            'calendly_link' => 'required|string',
            'calendly_text' => 'required|string',
            'cashapp_link' => 'required|string',
            'cashapp_text' => 'required|string',
            'date_link' => 'required|string',
            'date_text' => 'required|string',
            'discord_link' => 'required|string',
            'discord_text' => 'required|string',
            'dribbble_link' => 'required|string',
            'dribbble_text' => 'required|string',
            'email_link' => 'required|string',
            'email_text' => 'required|string',
            'facebook_link' => 'required|string',
            'facebook_text' => 'required|string',
            'github_link' => 'required|string',
            'github_text' => 'required|string',
            'instagram_link' => 'required|string',
            'instagram_text' => 'required|string',
            'line_link' => 'required|string',
            'line_text' => 'required|string',
            'link_link' => 'required|string',
            'link_text' => 'required|string',
            'linkedin_link' => 'required|string',
            'linkedin_text' => 'required|string',
            'meet_link' => 'required|string',
            'meet_text' => 'required|string',
            'nintendo_link' => 'required|string',
            'nintendo_text' => 'required|string',
            'note_text' => 'required|string',
            'patreon_link' => 'required|string',
            'patreon_text' => 'required|string',
            'paypal_link' => 'required|string',
            'paypal_text' => 'required|string',
            'pdf' => 'mimes:pdf|max:10000',
            'pdf_text' => 'required|string',
            'phone_link' => 'required|string',
            'phone_text' => 'required|string',
            'pinterest_link' => 'required|string',
            'pinterest_text' => 'required|string',
            'psn_link' => 'required|string',
            'psn_text' => 'required|string',
            'signal_link' => 'required|string',
            'signal_text' => 'required|string',
            'skype_link' => 'required|string',
            'skype_text' => 'required|string',
            'snapchat_link' => 'required|string',
            'snapchat_text' => 'required|string',
            'soundcloud_link' => 'required|string',
            'soundcloud_text' => 'required|string',
            'spotify_link' => 'required|string',
            'spotify_text' => 'required|string',
            'teams_link' => 'required|string',
            'teams_text' => 'required|string',
            'telegram_link' => 'required|string',
            'telegram_text' => 'required|string',
            'tiktok_link' => 'required|string',
            'tiktok_text' => 'required|string',
            'twitch_link' => 'required|string',
            'twitch_text' => 'required|string',
            'venmo_link' => 'required|string',
            'venmo_text' => 'required|string',
            'vimeo_link' => 'required|string',
            'vimeo_text' => 'required|string',
            'webex_link' => 'required|string',
            'webex_text' => 'required|string',
            'website_link' => 'required|string',
            'website_text' => 'required|string',
            'wechat_link' => 'required|string',
            'wechat_text' => 'required|string',
            'whatsapp_link' => 'required|string',
            'whatsapp_text' => 'required|string',
            'x.com_link' => 'required|string',
            'x.com_text' => 'required|string',
            'xbox_link' => 'required|string',
            'xbox_text' => 'required|string',
            'xing_link' => 'required|string',
            'xing_text' => 'required|string',
            'yelp_link' => 'required|string',
            'yelp_text' => 'required|string',
            'youtube_link' => 'required|string',
            'youtube_text' => 'required|string',
            'zelle_link' => 'required|string',
            'zelle_text' => 'required|string',
            'zoom_link' => 'required|string',
            'zoom_text' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $card = Card::create($request->all());
        if ($profile_photo = $request->file('profile_photo')) {
            $destinationPath = 'images/profile_photo';
            $imageName = date('YmdHis') . "." . $profile_photo->getClientOriginalExtension();
            $profile_photo->move($destinationPath, $imageName);
            $card->profile_photo = 'images/profile_photo/'."$imageName";
        }
        if ($logo = $request->file('logo')) {
            $destinationPath = 'images/logo';
            $imageName = date('YmdHis') . "." . $logo->getClientOriginalExtension();
            $logo->move($destinationPath, $imageName);
            $card->logo = 'images/logo/'."$imageName";
        }
        if ($badge = $request->file('badge')) {
            $destinationPath = 'images/badge';
            $imageName = date('YmdHis')."-".$badge->getClientOriginalExtension();
            $badge->move($destinationPath, $imageName);
            $card->badge = 'images/badge/'."$imageName";
        }
        if ($pdf = $request->file('pdf')) {
            $destinationPath = 'pdf';
            $imageName = date('YmdHis')."-".$pdf->getClientOriginalExtension();
            $pdf->move($destinationPath, $imageName);
            $card->pdf = 'pdf/'."$imageName";
        }
        $card->save();

        return response()->json([
            'success' => true,
            'message' => 'Card created successfully !',
            "card" => $card,
        ]);
    }
}
