<?php

class Slownie
{
    public function liczba($number)
    {
        if (is_numeric($number) === false) {
            throw new Exception("Passed parameter isn't numeric");
        }

        // Convert to string
        if (is_float($number)) {
            $number = number_format($number, 9);
        }

        $numberArray = explode('.', $number);

        if (count($numberArray) < 2) {
            $numberArray[1] = '0';
        }

        $int  = $this->integerToText($numberArray[0]);
        $frac = $this->fractionToText($numberArray[1]);

        if ($frac == '') {
            return $int;
        } else {
            return $int . ' i ' . $frac;
        }
    }

    public function kwota($number)
    {
        // ...
    }

    private function integerToText($number)
    {
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

        $array = $this->numberToArray($number);

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

    private function fractionToText($number, $shortFormat = false)
    {
        $number = rtrim($number, '0');

        if ($number == '') {
            return $number;
        }

        $groups = [
            [''                         ,''                         ,''                           ],
            [' dziesiąta'               ,' dziesiąte'               ,' dziesiątych'               ],
            [' setna'                   ,' setne'                   ,' setnych'                   ],
            [' tysięczna'               ,' tysięczne'               ,' tysięcznych'               ],
            [' dziesięciotysięczna'     ,' dziesięciotysięczne'     ,' dziesięciotysięcznych'     ],
            [' stutysięczna'            ,' stutysięczne'            ,' stutysięcznych'            ],
            [' milionowa'               ,' milionowe'               ,' milionowych'               ],
            [' dziesięciomilionowa'     ,' dziesięciomilionowe'     ,' dziesięciomilionowych'     ],
            [' stumilionowa'            ,' stumilionowe'            ,' stumilionowych'            ],
            [' miliardowa'              ,' miliardowe'              ,' miliardowych'              ],
            [' dziesięciomiliardowa'    ,' dziesięciomiliardowe'    ,' dzięsieciomiliardowych'    ],
            [' stumiliardowa'           ,' stumiliardowe'           ,' stumiliardowych'           ],
            [' bilionowa'               ,' bilionowe'               ,' bilionowych'               ],
            [' dzięsięciobilionowa'     ,' dzięsięciobilionowe'     ,' dzięsięciobilionowych'     ],
            [' stubilionowa'            ,' stubilionowe'            ,' stubilionowych'            ],
            [' biliardowa'              ,' biliardowe'              ,' biliardowych'              ],
            [' dzięsięciobiliardowa'    ,' dzięsięciobiliardowe'    ,' dzięsięciobiliardowych'    ],
            [' stubiliardowa'           ,' stubiliardowe'           ,' stubiliardowych'           ],
            [' trylionowa'              ,' trylionowe'              ,' trylionowych'              ],
            [' dziesięciotrylionowa'    ,' dziesięciotrylionowe'    ,' dziesięciotrylionowych'    ],
            [' stutrylionowa'           ,' stutrylionowe'           ,' stutrylionowych'           ],
            [' tryliardowa'             ,' tryliardowe'             ,' tryliardowych'             ],
            [' dzięsięciotryliardowa'   ,' dzięsięciotryliardowe'   ,' dzięsięciotryliardowych'   ],
            [' stutryliardowa'          ,' stutryliardowe'          ,' stutryliardowych'          ],
            [' kwadrylionowa'           ,' kwadrylionowe'           ,' kwadrylionowych'           ],
            [' dzięsięciokwadrylionowa' ,' dzięsięciokwadrylionowe' ,' dzięsięciokwadrylionowych' ],
            [' stukwadrylionowa'        ,' stukwadrylionowe'        ,' stukwadrylionowych'        ],
            [' kwadryliardowa'          ,' kwadryliardowe'          ,' kwadryliardowych'          ],
            [' dzięsięciokwadryliardowa',' dzięsięciokwadryliardowe',' dzięsięciokwadryliardowych'],
            [' stukwadryliardowa'       ,' stukwadryliardowe'       ,' stukwadryliardowych'       ],
            [' kwintylionowa'           ,' kwintylionowe'           ,' kwintylionowych'           ],
            [' dzięsięciokwintylionowa' ,' dzięsięciokwintylionowe' ,' dzięsięciokwintylionowych' ],
            [' stukwintylionowa'        ,' stukwintylionowe'        ,' stukwintylionowych'        ],
            [' kwintyliardowa'          ,' kwintyliardowe'          ,' kwintyliardowych'          ],
            [' dzięsięciokwintyliardowa',' dzięsięciokwintyliardowe',' dzięsięciokwintyliardowych'],
            [' stukwintyliardowa'       ,' stukwintyliardowe'       ,' stukwintyliardowych'       ],
            [' sekstylionowa'           ,' sekstylionowe'           ,' sekstylionowych'           ],
            [' dziesięciosekstylionowa' ,' dziesięciosekstylionowe' ,' dziesięciosekstylionowych' ],
            [' stusekstylionowa'        ,' stusekstylionowe'        ,' stusekstylionowych'        ],
            [' sekstyliardowa'          ,' sekstyliardowe'          ,' sekstyliardowych'          ],
            [' dziesięciosekstyliardowa',' dziesięciosekstyliardowe',' dziesięciosekstyliardowych'],
            [' stusekstyliardowa'       ,' stusekstyliardowe'       ,' stusekstyliardowych'       ],
            [' septylionowa'            ,' septylionowe'            ,' septylionowych'            ],
            [' dziesięcioseptylionowa'  ,' dziesięcioseptylionowe'  ,' dziesięcioseptylionowych'  ],
            [' stuseptylionowa'         ,' stuseptylionowe'         ,' stuseptylionowych'         ],
            [' septyliardowa'           ,' septyliardowe'           ,' septyliardowych'           ],
            [' dziesięcioseptyliardowa' ,' dziesięcioseptyliardowe' ,' dziesięcioseptyliardowych' ],
            [' stuseptyliardowa'        ,' stuseptyliardowe'        ,' stuseptyliardowych'        ],
            [' oktylionowa'             ,' oktylionowe'             ,' oktylionowych'             ],
            [' dziesięciooktylionowa'   ,' dziesięciooktylionowe'   ,' dziesięciooktylionowych'   ],
            [' stuoktylionowa'          ,' stuoktylionowe'          ,' stuoktylionowych'          ],
            [' oktyliardowa'            ,' oktyliardowe'            ,' oktyliardowych'            ],
            [' dziesięciooktyliardowa'  ,' dziesięciooktyliardowe'  ,' dziesięciooktyliardowych'  ],
            [' stuoktyliardowa'         ,' stuoktyliardowe'         ,' stuoktyliardowych'         ],
            [' nonylionowa'             ,' nonylionowe'             ,' nonylionowych'             ],
            [' dziesięciononylionowa'   ,' dziesięciononylionowe'   ,' dziesięciononylionowych'   ],
            [' stunonylionowa'          ,' stunonylionowe'          ,' stunonylionowych'          ],
            [' nonyliardowa'            ,' nonyliardowe'            ,' nonyliardowych'            ],
            [' dziesięciononyliardowa'  ,' dziesięciononyliardowe'  ,' dziesięciononyliardowych'  ],
            [' stunonyliardowa'         ,' stunonyliardowe'         ,' stunonyliardowych'         ],
            [' decylionowa'             ,' decylionowe'             ,' decylionowych'             ],
            [' dziesięciodecylionowa'   ,' dziesięciodecylionowe'   ,' dziesięciodecylionowych'   ],
            [' studecylionowa'          ,' studecylionowe'          ,' studecylionowych'          ],
            [' decyliardowa'            ,' decyliardowe'            ,' decyliardowych'            ],
            [' dziesięciodecyliardowa'  ,' dziesięciodecyliardowe'  ,' dziesięciodecyliardowych'  ],
            [' studecyliardowa'         ,' studecyliardowe'         ,' studecyliardowych'         ]
        ];

        $array = $this->numberToArray($number);
        $arrayLength = count($array);

        $s = intval($array[$arrayLength - 1][2]);
        $t = intval($array[$arrayLength - 1][1]);
        $h = intval($array[$arrayLength - 1][0]);

        $isTeens = ($t === 1 && $s !== 0) ? 1 : 0;

        // Choose valid grammar form
        if ($s === 1 &&  ($h + $t + $isTeens) === 0) {
            $grammarForm = 0;
        } elseif ($s === 2 || $s === 3 || $s === 4) {
            $grammarForm = 1;
        } else {
            $grammarForm = 2;
        }

        $trimmedNumber = ltrim($number, '0');

        if ($trimmedNumber == '1') {
            $result = 'jedna';
        } elseif ($trimmedNumber == '2') {
            $result = 'dwie';
        } else {
            $result = $this->integerToText($number);
        }

        $numberLength = strlen($number);

        $result .= $groups[$numberLength][$grammarForm];

        return $result;
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
