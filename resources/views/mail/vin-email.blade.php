<x-mail::message>
# Your Voter's Identity Number

    Dear {{ $name }}
Your Voter Identification Number is {{ $voterId }}. Voting ends by {{ $stopTime }}

<x-mail::button :url="$url">
Click here to cast your vote
</x-mail::button>

Thanks,<br>
{{ "NACOS FULafia" }}
</x-mail::message>
