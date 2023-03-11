<?php

namespace App\Controllers;

class AddVenueController extends PageController
{
    public function process(): void
    {
        $request = $this->getRequest();
        try {
            $name = $request->getProperty('venue_name');
            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback("Укажите название заведения");
                $this->render(__DIR__ . '/../../views/add_venue.php', $request);
                return;
            } else if (is_null($name) || $name === '') {
                $request->addFeedback("Название - обязательное поле");
                $this->render(__DIR__ . '/../../views/add_venue.php', $request);
                return;
            } else {
                // добавление в базу данных
                $this->forward('listvenues.php');
            }
        } catch (\Exception) {
            $this->render(__DIR__ . '/../../views/error.php', $request);
        }
    }
}