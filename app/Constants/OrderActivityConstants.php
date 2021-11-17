<?php

namespace App\Constants;

class OrderActivityConstants
{
   const STATUS_OPTIONS = [
       StatusConstants::PENDING => "Mark as Pending",
       StatusConstants::PROCESSING => "Mark as Processing",
       StatusConstants::COMPLETED => "Mark as Completed",
       StatusConstants::CANCELLED => "Mark as Cancelled",
   ];

   const UPDATE_STATUS = "UPDATE_STATUS";
}
