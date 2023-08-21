<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Appointment;
use Carbon\Carbon;
class AppointmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Appointments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointments = Appointment::where('visited', 0)->get();
        foreach($appointments as $appointment){
            //echo $appointment->date->format('d-m-Y').'***';
            $date_from = Carbon::createFromFormat('d-m-Y H:i', $appointment->date->format('d-m-Y').' '.$appointment->time_end);
            $now = now();

            $result = $now->gt($date_from);

            if($result){
                        $appointmento = Appointment::find($appointment->id);
                        $appointmento->visited = 2;
                        $appointmento->update();
            }

        }
    }
}
