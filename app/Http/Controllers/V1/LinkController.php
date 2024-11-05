<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\V1\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LinkController extends Controller
{
    /**
     * Display a listing of the links for the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $links = Link::where('user_id', $request->user()->id)->get();

        return LinkResource::collection($links)->response();
    }

    /**
     * Redirect to the long URL associated with the given short URL key.
     *
     * @param string $key
     * @return RedirectResponse
     * @throws NotFoundHttpException
     */
    public function redirect($key): RedirectResponse
    {
        $link = Link::where('short_url_key', $key)->first();

        if (!$link) {
            abort(404);
        }

        $link->visit_count = $link->visit_count + 1;
        $link->save();

        return redirect()->away($link->long_url);
    }

    /**
     * Store a newly created link in the database.
     *
     * @param LinkRequest $request
     * @return JsonResponse
     */
    public function store(LinkRequest $request): JsonResponse
    {
        $link =  Link::where('long_url', $request->long_url)->first();

        if (!$link) {
            $shortKey = Str::random(7);

            $exists = Link::where('short_url_key', $shortKey)->exists();

            while ($exists) {
                $shortKey = Str::random(7);
                $exists = Link::where('short_url_key', $shortKey)->exists();
            }

            $link = $request->user()->links()->create([
                'long_url' => $request->long_url,
                'short_url_key' => $shortKey,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Short link generated successfully.',
            'data' => [
                'long_url' => $link->long_url,
                'short_url' => $link->short_url,
            ],
        ], Response::HTTP_CREATED);
    }
}
