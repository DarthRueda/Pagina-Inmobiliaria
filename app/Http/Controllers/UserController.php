namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ...existing code...

    public function getUserData()
    {
        return response()->json(Auth::user());
    }
}
