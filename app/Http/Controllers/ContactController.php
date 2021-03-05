<?php
/**
 * Contact controller
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiries;
use Notification;
use App\Notifications\InquiriesNotifications;
use App\Http\Requests\InquiriesRequest;

/**
 * This class uses for contact us page.
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{

    /**
     * Show contact us page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Contact us page
     */
    public function index()
    {
        return view( 'contact' );
    }

    /**
     * Store a new blog post.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( InquiriesRequest $request )
    {
        $inquirie          = new Inquiries;
        $inquirie->name    = $request->name;
        $inquirie->email   = $request->email;
        $inquirie->phone   = $request->phone;
        $inquirie->message = $request->message;
        $inquirie->save();

        $details = [
            'greeting'   => 'Hi Innovation team,',
            'body'       => 'This is ' . $inquirie->name . ' greeting message. "' . $inquirie->message . '"',
            'thanks'     => 'Thank you',
            'actionText' => 'Back to site',
            'actionURL'  => url( '/' ),
            'id'         => $inquirie->id,
        ];

        Notification::send( $inquirie, new InquiriesNotifications( $details ) );

        return response()->json(
            [
                'success' => true,
                'message' => 'Your information has been saved. We will contact you shortly.',
            ]
        );
    }

}