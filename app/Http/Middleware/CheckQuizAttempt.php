<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CandidatQuiz;
use Illuminate\Support\Facades\Auth;

class CheckQuizAttempt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $candidatId = Auth::user()->candidat->id;
        $quizAttempt  = CandidatQuiz::where('candidat_id', $candidatId)->latest()->firstOrFail();

        if ($quizAttempt) {
            return redirect()->route('verification.message')->with('message', 'You have already completed this quiz.');
        }

        return $next($request);
    }
}
