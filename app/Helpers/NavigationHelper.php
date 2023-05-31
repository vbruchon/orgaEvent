<?php

namespace App\Helpers;

use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminEventController;


class NavigationHelper
{
    public static function getNavigationLinks()
    {
        $links = [];

        if (auth()->check()) {
            $user = auth()->user();

            if ($user->is_admin) {
                // Liens pour les administrateurs
                $links[] = ['url' => route('userEvent.all'), 'label' => 'Événements'];
                $links[] = ['url' => route('admin.structure.list'), 'label' => 'Structures'];
                $links[] = ['url' => route('admin.status.list'), 'label' => 'Status'];
                $links[] = ['url' => route('admin.numberOfParticipants.list'), 'label' => 'Nombre de participants'];
                $links[] = ['url' => route('admin.users.list'), 'label' => 'Utilisateurs'];
            } else {
                $links[] = ['url' => route('userEvent.all'), 'label' => 'Événements'];
            }
        }
        return $links;
    }
}
