<?php

namespace App\Http\Controllers\Api\Reviews;

use App\Enums\Api\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Reviews\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function toggleReview(ReviewRequest $request)
    {
        $user = Auth::user();

        if (!$user) {
            return generalApiResponse(method: ResponseMethodEnum::CUSTOM, custom_message: __('Unauthorized access to Review'), custom_status_msg: 'fail', custom_status: 403
            );
        }
        Review::updateOrCreate([
            'course_id' => $request->course_id,
            'user_id' => $user->id,
        ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

        return generalApiResponse(ResponseMethodEnum::CUSTOM, custom_message: __('Your review has been added'), custom_status_msg: 'success', custom_status: 200);

    }
}
