<?php

namespace App\Http\Controllers\Web\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct(protected ContactService $service)
    {
    }
    public function __invoke(ContactRequest $request): RedirectResponse
    {
        $sendMessage = $this->service->sendEmail($request->all());
        
        return redirect(route('contact_us', ['locale' => app()->getLocale()], absolute: false));

    }
}
