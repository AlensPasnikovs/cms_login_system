<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserContainer implements ShouldQueue {

   use InteractsWithQueue;
   /**
    * Create the event listener.
    *
    * @return void
    */
   public function __construct() {
      //
   }

   /**
    * Handle the event.
    *
    * @param  \App\Events\NewUserRegistered  $event
    * @return void
    */
   public function handle(NewUserRegistered $event) {
      $subdomain = escapeshellarg($event->subdomain);

      if ($event->button == '2') {
         // Execute shell script for button 1
         shell_exec("ssh alens@host.docker.internal 'bash /home/alens/projects/main_app/zDocker_cms/new_blog.sh $subdomain'");
      } else if ($event->button == '1') {
         // Execute shell script for button 2
         shell_exec("ssh alens@host.docker.internal 'bash /home/alens/projects/main_app/zDocker_cms/regular_blog.sh $subdomain'");
      }
   }
}
