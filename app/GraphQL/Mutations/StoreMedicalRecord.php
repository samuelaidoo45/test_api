<?php

namespace App\GraphQL\Mutations;

final class StoreMedicalRecord
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        //print_r($args);
        
        return response(
            [
                'message' => 'Medical Record Created Successfully',
                'status' => 200
            ],
            200
        );
    }
}
