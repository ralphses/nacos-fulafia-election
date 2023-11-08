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
        'Welfare Director',
        'Financial Secretary',
        'Director of Sports',
        'Director of Socials',
        'Director, Media and Publicity I',
        'Director, Media and Publicity II',
        'Auditor General',
        'Director of Academics I',
        'Director of Academics II',
        'Director of Research and Innovation I',
        'Director of Research and Innovation II',
        'Provost Marshal',
    ];

    public const LEVELS = ['200' => '200 Level', '300' => '300 Level'];

    public const ELECTION_STATUS = [
        'start' => 'CREATED',
        'on' => 'ONGOING',
        'stop' => 'STOPPED',
    ];

}
