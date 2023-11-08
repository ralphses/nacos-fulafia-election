<?php

namespace App\Utils;

class Utility
{
    public const ROLES = ['voter' => 'VOTER', 'admin' => 'ADMIN'];

    public const POSITIONS = [
        'President',
        'Vice President',
        'Secretary General',
        'Assistant Secretary General',
        'Senator',
        'Treasurer',
        'Welfare Director I',
        'Welfare Director II',
        'Financial Secretary',
        'Director of Sports I',
        'Director of Sports II',
        'Director of Socials I',
        'Director of Socials II',
        'Director, Media and Publicity I',
        'Director, Media and Publicity II',
        'Director, Media and Publicity III',
        'Auditor General',
        'Director of Academics I',
        'Director of Academics II',
        'Director of Research and Innovation I',
        'Director of Research and Innovation II',
        'Provost Marshal'
    ];

    public const LEVELS = ['200' => '200 Level', '300' => '300 Level'];

    public const ELECTION_STATUS = [
        'start' => 'CREATED',
        'on' => 'ONGOING',
        'stop' => 'STOPPED',
    ];

    public static function readVoters() {
        $jsonFilePath = base_path('voters.json'); // Path to your JSON file at the root of the project

        $voters = json_decode(file_get_contents($jsonFilePath));

        $objects = [];
        foreach ($voters as $voter) {
            
            $objects[] = ($voter->MatricNumber);
        }

       return $objects;
    }

}
