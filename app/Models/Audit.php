<?php

namespace App\Models;

use Carbon\Carbon;
use OwenIt\Auditing\Models\Audit as BaseAudit;

class Audit extends BaseAudit
{
    public function getFormattedMetadata(): array
    {
        $metadata = $this->getMetadata();
        $metadata['audit_created_at'] = Carbon::parse($this->created_at)
            ->format('F d, Y H:i:s a');

        return $metadata;
    }
}
