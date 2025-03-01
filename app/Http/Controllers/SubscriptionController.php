<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;

class FormController extends Controller {
    public function submit(Request $request) {
        // Validate
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // sanitize
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);

        // Check if email already exists
        $subscription = Subscription::where('email', $email)->first();

        if ($subscription) {
            return redirect()->back()->with('error', 'Email already exists');
        } else {
            // Iniciar transacción
            DB::beginTransaction();

            try {
                // Crear suscripción
                $subscription = new Subscription();
                $subscription->email = $email;
                $subscription->save();

                // Commit
                DB::commit();

                return redirect()->back()->with('success', 'Email saved');
            } catch (\Exception $e) {
                // Rollback
                DB::rollBack();

                return redirect()->back()->with('error', 'Error saving email');
            }
            
        }
    }
}
