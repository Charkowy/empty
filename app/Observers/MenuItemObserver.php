<?php

namespace App\Observers;

use App\Models\MenuItem;

class MenuItemObserver
{
    /**
     * Handle the MenuItem "created" event.
     */
    public function created(MenuItem $menuItem): void
    {
        //
    }

    public function creating(MenuItem $menuItem): void
    {
        $menuItem->parent_id = $menuItem->parent_id ?? MenuItem::max('id') + 1;
        // Incrementar las posiciones mayores o iguales a la nueva posición
        MenuItem::where('position', '>=', $menuItem->position)->increment('position');
    }

    /**
     * Handle the MenuItem "updating" event.
     */
    public function updating(MenuItem $menuItem): void
    {
        $originalPosition = $menuItem->getOriginal('position');
        $newPosition = $menuItem->position;

        if ($menuItem->isDirty('position')) {
            // Si la posición original es diferente de la nueva, ajustar las posiciones
            if ($originalPosition < $newPosition) {
                MenuItem::where('position', '>', $originalPosition)
                    ->where('position', '<=', $newPosition)
                    ->decrement('position');
            } else {
                MenuItem::where('position', '>=', $newPosition)
                    ->where('position', '<', $originalPosition)
                    ->increment('position');
            }
        }
    }

    /**
     * Handle the MenuItem "deleted" event.
     */
    public function deleted(MenuItem $menuItem): void
    {
        //
    }

    /**
     * Handle the MenuItem "restored" event.
     */
    public function restored(MenuItem $menuItem): void
    {
        //
    }

    /**
     * Handle the MenuItem "force deleted" event.
     */
    public function forceDeleted(MenuItem $menuItem): void
    {
        //
    }
}
