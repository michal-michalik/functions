<?php

class Slownie
{
    /**
     * @param $number
     * @return string
     * @throws Exception
     */
    public function liczba($number)
    {
        if (is_numeric($number) === false) {
            throw new Exception("Passed parameter isn't numeric");
        }

        if ($number == 0) {
            return "zero";
        }

        $singles   = ['', ' jeden', ' dwa', ' trzy', ' cztery', ' pięć', ' sześć', ' siedem', ' osiem', ' dziewięć'];
        $teens     = ['', ' jedenaście', ' dwanaście', ' trzynaście', ' czternaście', ' piętnaście', ' szesnaście', ' siedemnaście', ' osiemnaście', ' dziewietnaście'];
        $tens      = ['', ' dziesieć', ' dwadzieścia', ' trzydzieści', ' czterdzieści', ' pięćdziesiąt', ' sześćdziesiąt', ' siedemdziesiąt', ' osiemdziesiąt', ' dziewięćdziesiąt'];
        $hundreds  = ['', ' sto', ' dwieście', ' trzysta', ' czterysta', ' pięćset', ' sześćset', ' siedemset', ' osiemset', ' dziewięćset'];
        $groups    = [
            [''             ,''             ,''              ],
            [' tysiąc'      ,' tysiące'     ,' tysięcy'      ],
            [' milion'      ,' miliony'     ,' milionów'     ],
            [' miliard'     ,' miliardy'    ,' miliardów'    ],
            [' bilion'      ,' biliony'     ,' bilionów'     ],
            [' biliard'     ,' biliardy'    ,' biliardów'    ],
            [' trylion'     ,' tryliony'    ,' trylionów'    ],
            [' tryliard'    ,' tryliardy'   ,' tryliardów'   ],
            [' kwadrylion'  ,' kwadryliony' ,' kwadrylionów' ],
            [' kwadryliard' ,' kwadryliardy',' kwadryliardów'],
            [' kwintylion'  ,' kwintyliony' ,' kwintylionów' ],
            [' kwintyliard' ,' kwintyliardy',' kwintyliardów'],
            [' sekstylion'  ,' sekstyliony' ,' sektylionów'  ],
            [' sekstyliard' ,' sektyliardy' ,' sekstyliardów'],
            [' septylion'   ,' septyliony'  ,' septylionów'  ],
            [' septyliard'  ,' septyliardy' ,' septyliardów' ],
            [' oktylion'    ,' oktyliony'   ,' oktylionów'   ],
            [' oktyliard'   ,' oktyliardy'  ,' oktyliardów'  ],
            [' nonylion'    ,' nonyliony'   ,' nonylionów'   ],
            [' nonyliard'   ,' nonyliardy'  ,' nonyliardów'  ],
            [' decylion'    ,' decyliony'   ,' decylionów'   ],
            [' decyliard'   ,' decyliardy'  ,' decyliardów'  ]
        ];

        $sign   = '';
        $result = '';

        if ($number[0] == '-') {
            $sign = 'minus';
            $number = substr($number, 1, strlen($number) - 1);
        }

        $array  = $this->numberToArray($number);

        $arrayLength = count($array);
        for ($i = 0, $g = $arrayLength - 1; $i < $arrayLength; $i++, $g--) {
            $s = intval($array[$i][2]);
            $t = intval($array[$i][1]);
            $h = intval($array[$i][0]);

            if ($s === 0 && $t === 0 && $h === 0) {
                continue;
            }

            $isTeens = ($t === 1 && $s !== 0) ? 1 : 0;

            // Choose valid grammar form
            if ($s === 1 &&  ($h + $t + $isTeens) === 0) {
                $grammarForm = 0;
            } elseif ($s === 2 || $s === 3 || $s === 4) {
                $grammarForm = 1;
            } else {
                $grammarForm = 2;
            }

            if ($isTeens) {
                $result .= $hundreds[$h] . $teens[$s] . $groups[$g][$grammarForm];
            } else {
                $result .= $hundreds[$h] . $tens[$t] . $singles[$s] . $groups[$g][$grammarForm];
            }
        }

        $result = trim($sign . $result);

        return $result;

    }

    public function kwota($number)
    {

    }

    private function numberToArray($number)
    {
        $numberLength = strlen($number);
        $spaces = (3 - $numberLength % 3) % 3;

        switch ($spaces) {
            case 1:
                $number = ' ' . $number;
                break;
            case 2:
                $number = '  ' . $number;
                break;
        }

        $array  = str_split($number, 3);

        return $array;
    }
}
