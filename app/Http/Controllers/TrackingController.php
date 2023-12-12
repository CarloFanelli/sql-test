<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Carbon\Carbon;



class TrackingController extends Controller
{
    public function index()
    {
        $clients = []; // Array per memorizzare i dati dei clienti

        // Ottenere tutti i clienti
        $uniqueCustomers = Tracking::select('id_customer')->distinct()->get();
        //dd($uniqueCustomers);

        foreach ($uniqueCustomers as $customer) {
            /* creo il customer */
            $clientData = [
                'client_id' => $customer->id_customer,
                'total_hours_per_employee' => [], // Array per memorizzare le ore totali per ciascun dipendente
                'total_hours' => 0, // Ore totali di tutti i dipendenti per il cliente
            ];

            // Ottenere le attività per il cliente corrente
            $activities = Tracking::where('id_customer', $customer->id_customer)->get();

            foreach ($activities as $activity) {

                $employeeId = $activity->id_user;
                $startTime = strtotime($activity->h_from);
                $endTime = strtotime($activity->h_to);
                $hoursWorked = ($endTime - $startTime); // Calcolo dei secondi impiegati

                if (!isset($clientData['total_hours_per_employee'][$employeeId])) {
                    $clientData['total_hours_per_employee'][$employeeId] = 0;
                }

                // Aggiornamento delle ore totali per ciascun dipendente
                $clientData['total_hours_per_employee'][$employeeId] += $hoursWorked;

                // Aggiornamento delle ore totali per il cliente
                $clientData['total_hours'] += $hoursWorked;
            }

            // Formattazione delle ore totali nel formato [HH] h [MM] m
            $time = $clientData['total_hours'];
            //dd($time);
            $hours = floor($time / 3600);
            $time %= 3600;
            $mins = floor($time / 60);
            $time %= 60;
            $secs = $time;

            $clientData['total_hours'] = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

            foreach ($clientData['total_hours_per_employee'] as $employeeId => $time) {
                //dd($time);
                $hours = floor($time / 3600);
                $time %= 3600;
                $mins = floor($time / 60);
                $time %= 60;
                $secs = $time;

                $clientData['total_hours_per_employee'][$employeeId] = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
            }

            $clients[] = $clientData;
        }

        //dd($clients);

        return view('tracking.index')->with('clients', $clients);
    }
}
