<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Validator;
use App\Http\Controllers\EmailController;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('userRole', ['only' => ['getRegister', 'postRegister', 'getUserList']], 'guest', ['except' => 'getLogout']);
		//$this->middleware('guest', ['except' => 'getLogout']);
		
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{	
		
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{	
			return redirect()->intended($this->redirectPath());
		}
		
		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	protected function getFailedLoginMessage()
	{
	    return 'These credentials do not match our records.';
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{	
		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());
		//print_r($request->all());exit;
		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->registrar->create($request->all());
		
		$result = (new EmailController)->sendMailWithoutAttach($request);

		return redirect('/users/user_list');
	}

	public function getUserList()
	{
		$users = User::orderBy('id','ASC')->get();
		return view('auth.list', ['user_list' => $users]);
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {
        //
        
        $data['user_detail'] = User::where('id',$id)->firstOrFail();
        return view('auth.user_edit', $data);
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $req)
	{
		$v = Validator::make($req->all(), [
	        'name' => 'required',
	        'email' => 'required',
	        'password'=>'min:6|confirmed',
        	'password_confirmation'=>'sometimes|required_with:password',
    	]);


    	if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
	    else{
	    	$user = User::find ( $req->id );
	        $user->name = $req->name;
	        $user->email = $req->email;
	        $user->user_role = $req->user_role;
			
	        if($req->password){
	        	$user->password = bcrypt($req->password);
	        }

	        $user->save ();

	        return redirect('users/user_list');
	    }
		
	}

	public function destroy($id){
		$user = User::where("id", $id)->firstOrFail();

		$user->where("id", $id)->delete();
		return $id;
		//return redirect('users/user_list');
	}

}
