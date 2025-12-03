use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::prefix('v1/cliente')->group(function () {
    Route::get('/login', [ClienteController::class, 'getCliente']);
    Route::post('/', [ClienteController::class, 'setCliente']);
    Route::post('/codigo', [ClienteController::class, 'generarCodigo']);
});
