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
            'card_name' => 'string',
            'prefix' => 'string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'suffix' => 'string',
            'accreditation' => 'string',
            'preferred_name' => 'string',
            'maiden_name' => 'string',
            'pronouns' => 'string',
            'title' => 'required|string',
            'department' => 'required|string',
            'company' => 'required|string',
            'headline' => 'required|string',
            'address_link' => 'string',
            'address_text' => 'string',
            'applemusic_link' => 'string',
            'applemusic_text' => 'string',
            'behance_link' => 'string',
            'behance_text' => 'string',
            'bookings_link' => 'string',
            'bookings_text' => 'string',
            'brightcove_link' => 'string',
            'brightcove_text' => 'string',
            'calendly_link' => 'string',
            'calendly_text' => 'string',
            'cashapp_link' => 'string',
            'cashapp_text' => 'string',
            'date_link' => 'string',
            'date_text' => 'string',
            'discord_link' => 'string',
            'discord_text' => 'string',
            'dribbble_link' => 'string',
            'dribbble_text' => 'string',
            'email_link' => 'string',
            'email_text' => 'string',
            'facebook_link' => 'string',
            'facebook_text' => 'string',
            'github_link' => 'string',
            'github_text' => 'string',
            'instagram_link' => 'string',
            'instagram_text' => 'string',
            'line_link' => 'string',
            'line_text' => 'string',
            'link_link' => 'string',
            'link_text' => 'string',
            'linkedin_link' => 'string',
            'linkedin_text' => 'string',
            'meet_link' => 'string',
            'meet_text' => 'string',
            'nintendo_link' => 'string',
            'nintendo_text' => 'string',
            'note_text' => 'string',
            'patreon_link' => 'string',
            'patreon_text' => 'string',
            'paypal_link' => 'string',
            'paypal_text' => 'string',
            'pdf' => 'mimes:pdf|max:10000',
            'pdf_text' => 'string',
            'phone_link' => 'string',
            'phone_text' => 'string',
            'pinterest_link' => 'string',
            'pinterest_text' => 'string',
            'psn_link' => 'string',
            'psn_text' => 'string',
            'signal_link' => 'string',
            'signal_text' => 'string',
            'skype_link' => 'string',
            'skype_text' => 'string',
            'snapchat_link' => 'string',
            'snapchat_text' => 'string',
            'soundcloud_link' => 'string',
            'soundcloud_text' => 'string',
            'spotify_link' => 'string',
            'spotify_text' => 'string',
            'teams_link' => 'string',
            'teams_text' => 'string',
            'telegram_link' => 'string',
            'telegram_text' => 'string',
            'tiktok_link' => 'string',
            'tiktok_text' => 'string',
            'twitch_link' => 'string',
            'twitch_text' => 'string',
            'venmo_link' => 'string',
            'venmo_text' => 'string',
            'vimeo_link' => 'string',
            'vimeo_text' => 'string',
            'webex_link' => 'string',
            'webex_text' => 'string',
            'website_link' => 'string',
            'website_text' => 'string',
            'wechat_link' => 'string',
            'wechat_text' => 'string',
            'whatsapp_link' => 'string',
            'whatsapp_text' => 'string',
            'x.com_link' => 'string',
            'x.com_text' => 'string',
            'xbox_link' => 'string',
            'xbox_text' => 'string',
            'xing_link' => 'string',
            'xing_text' => 'string',
            'yelp_link' => 'string',
            'yelp_text' => 'string',
            'youtube_link' => 'string',
            'youtube_text' => 'string',
            'zelle_link' => 'string',
            'zelle_text' => 'string',
            'zoom_link' => 'string',
            'zoom_text' => 'string',
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
            $imageName = date('YmdHis') . "." . $profile_photo->getClientOriginalName();
            $profile_photo->move($destinationPath, $imageName);
            $card->profile_photo = 'images/profile_photo/'."$imageName";
        }
        if ($logo = $request->file('logo')) {
            $destinationPath = 'images/logo';
            $imageName = date('YmdHis') . "." . $logo->getClientOriginalName();
            $logo->move($destinationPath, $imageName);
            $card->logo = 'images/logo/'."$imageName";
        }
        if ($badge = $request->file('badge')) {
            $destinationPath = 'images/badge';
            $imageName = date('YmdHis')."-".$badge->getClientOriginalName();
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

    public function read(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $cards = Card::where("user_id","=",$request->user_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Cards fetched successfully !',
            'cards' => $cards,
        ]);
    }
}
