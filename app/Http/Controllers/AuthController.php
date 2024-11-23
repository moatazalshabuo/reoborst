<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Http\Requests\UsersRegisterRequest;
use Exception;
use App\Helpers\JWTHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller{
	

	/**
     * Get user login data
     * @return array
     */
	private function getUserLoginData($user = null){
		if(!$user){
			$user = auth()->user();
		}
		$accessToken = $user->createToken('authToken')->accessToken;
        return ['token' => $accessToken,
		'user' => $user];
	}
	

	/**
     * Authenticate and login user
     * @return \Illuminate\Http\Response
     */
	function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		Auth::attempt(['phonenumber' => $username, 'password' => $password]);
        if (!Auth::check()) {
            return $this->reject("Username or password not correct", 400);
        }
		$user = auth()->user();
		$loginData = $this->getUserLoginData($user);
        return $this->respond($loginData);
	}
	

	/**
     * Save new user record
     * @return \Illuminate\Http\Response
     */
	function register(UsersRegisterRequest $request){
		$modeldata = $request->validated();
		
		if( array_key_exists("img", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['img'], "img");
			$modeldata['img'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Users record
		$user = $record = Users::create($modeldata);
		$rec_id = $record->userid;
		$loginData =  $this->getUserLoginData($user);
		return $this->respond($loginData);
	}
	

	/**
     * generate token with user id
     * @return string
     */
	private function generateUserToken($user = null){
		return JWTHelper::encode($user->userid);
	}
	

	/**
     * validate token and get user id
     * @return string
     */
	private function getUserIDFromJwt($token){
		$userId =  JWTHelper::decode($token);
 		return $userId;
	}
}
