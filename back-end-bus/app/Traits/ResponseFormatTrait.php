<?php


namespace App\Traits;


use App\Classes\Configurations;
use App\Events\SendMailGenericEvent;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

/**
 * Trait ResponseFormatTrait
 * @package App\Traits
 * @author MSc. Raidel Berrillo González
 * @api v1
 * @version 1.0
 */
trait ResponseFormatTrait
{

    /**
     * @param bool $success
     * @param null $data
     * @param int $status
     * @param string|null $message
     * @param bool $sendAlert
     * @param mixed $error
     * @return JsonResponse
     */
    public static function responseTo(
        bool $success, $data = null, int $status = 200, string $message = null, bool $sendAlert = false,
        mixed $error = null, string $typeMessage = null
    ): JsonResponse
    {
        if (null === $typeMessage) {
            $typeMessage = 'success';
        }

        return response()->json(
            ['success' => $success, 'message' => $message, 'type_message' => $typeMessage, 'data' => $data], $status
        );
    }

    /**
     * @param mixed $errors
     * @return JsonResponse
     */
    public static function responseFailedValidation(mixed $errors): JsonResponse
    {
        $response = self::responseTo(
            success: false, data: ['code_error' => 300, 'errors_validations_fields' => $errors],
            status: 422, message: 'Error en la validación de datos', typeMessage: 'danger'
        );
        throw new HttpResponseException($response);
    }


}
