<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    $keys = array_keys($hotels[0]);

    // parking filter elements
    $parking = $_GET['parking'] ?? 'all';
    $rating = $_GET['rating'] ?? 'all';

    //text visible on the select area
    function selectText($var){
        switch ($var) {
            case 'all':
                return 'Tutti';
                break;
            case 'true':
                return 'Con Parcheggio';
                break;
            case 'false':
                return 'Senza Parcheggio';
                break;
            default:
                return $var;
                break;
        }
    }

    // function that filters hotels based on the inputs
    function filterHotels($hotels, $parking, $rating)
    {
        $filteredArray = [];
        $filteredArray = array_filter($hotels, function ($hotel) use ($parking, $rating) {
            // $parking == 'all' checks if the "all" option is selected
            // ($parking == 'true' && $hotel['parking'] == true) checks if the key "parking" is true and the option "Con Parcheggio" is selected
            // ($parking == 'false' && $hotel['parking'] == false) same as the line above but for the "Senza Parcheggio" ones
            // $rating == 'all' || $hotel['vote'] >= $rating) checks if there is a selected Rating in the second select or if the value is 'all'
            if (
                ($parking == 'all' || ($parking == 'true' && $hotel['parking'] == true) || ($parking == 'false' && $hotel['parking'] == false))
                &&
                ($rating == 'all' || $hotel['vote'] >= $rating))
                {
                    return true;
                }else{
                    return false;
                }
        });
        return $filteredArray;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Hotel</title>
</head>
<body>
    
    <header class="text-center py-3">
        <h1>HOTEL</h1>
    </header>

    <main>

        <div class="container">

            <div class="row">
                <div class="col-6">
                    <div class="mb-5">
                        <form action="index.php" method="GET" class="d-flex column-gap-3">
                            <div class="w-50">
                                <select name="parking" id="parking" class="form-select">
                                    <option value="<?= $parking ?>" selected hidden><?= selectText($parking)?></option>
                                    <option value="all">Tutti</option>
                                    <option value="false">Senza Parcheggio</option>
                                    <option value="true">Con Parcheggio</option>
                                </select>
                            </div>
                            <div class="w-25">
                                <select name="rating" id="rating" class="form-select">
                                <option value="<?= $rating ?>" selected hidden><?= selectText($rating) ?></option>
                                <option value="all">Tutti</option>
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                      <option value="<?= $i ?>"><?= $i ?></option>  
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Filtra</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                            <?php foreach($keys as $key): ?>
                                <th class="text-capitalize"> <?= $key ?> </th>
                            <?php endforeach;?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach(filterHotels($hotels, $parking, $rating) as $hotel): ?>
                                <tr class="text-center">
                                <?php foreach($hotel as $element): ?>
                                    <td> <?= $element ?> </td>
                                <?php endforeach;?>
                                </tr>
                            <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>