<?php
declare(strict_types=1);

namespace App\Application\Actions\Country;

use Psr\Http\Message\ResponseInterface as Response;

class GeneralCountryAction extends CountryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $result = [];
        $message = "use '/country-check/{country-code}'";
        $result[] = $message;

        $this->logger->info("You need a param");

        return $this->respondWithData($message);
    }
}
