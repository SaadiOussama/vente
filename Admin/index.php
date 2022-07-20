<?php
include 'functions.php';
$client_nbr = getFromDataBase("select COUNT(ID_CL) nbr FROM clients")[0]["nbr"];
$com_nbr = getFromDataBase("select COUNT(ID_COM) nbr FROM commandes")[0]["nbr"];
$art_nbr = getFromDataBase("select COUNT(ID_ART) nbr FROM articles")[0]["nbr"];
$art_com = getFromDataBase("SELECT a.DESI_ART, SUM(ac.QTE) NBR_QTE, SUM(ac.PRIX*ac.QTE) TOTAL FROM articles a JOIN art_com ac ON a.ID_ART=ac.ID_ART GROUP BY ac.ID_ART ORDER BY TOTAL DESC LIMIT 6");
$clients = getFromDataBase("SELECT c.NOM_CL, SUM(ac.QTE) NBR_QTE, SUM(ac.PRIX*ac.QTE) TOTAL FROM clients c JOIN commandes cm ON c.ID_CL=cm.ID_CL JOIN art_com ac ON cm.ID_COM=ac.ID_COM GROUP BY c.ID_CL ORDER BY TOTAL DESC LIMIT 6");
$chiffre_affaire = getFromDataBase("SELECT * FROM (SELECT MONTH(cm.DATE_LIVR) month,YEAR(cm.DATE_LIVR) year, SUM(ac.QTE) NBR_QTE, SUM(ac.PRIX*ac.QTE) TOTAL FROM clients c JOIN commandes cm ON c.ID_CL=cm.ID_CL JOIN art_com ac ON cm.ID_COM=ac.ID_COM WHERE cm.ETAT_COM LIKE 'livr' GROUP BY MONTH(cm.DATE_LIVR),YEAR(cm.DATE_LIVR) ORDER BY MONTH(cm.DATE_LIVR),YEAR(cm.DATE_LIVR) DESC LIMIT 12) t ORDER BY t.month, t.year");
$page_title = "Accueil";
include 'header.php';
?>
<section class="container">
    <div class="row">
        <div class="col-sm-4" style="padding: 20px;text-align: center;">
            <div class=" stat">
                <div class="row ">
                    <div class="col" style="padding-top: 4px;"><i class="fas fa-users fa-5x"></i> </div>
                    <div class="col">
                        <a href="clients.php"><span style="font-size: 20px; font-weight: bolder;">CLIENTS</span></a><br><br>
                        <span class="stat_nbr"><?= $client_nbr ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4" style="padding: 20px;text-align: center;">
            <div class=" stat">
                <div class="row ">
                    <div class="col" style="padding-top: 4px;"><i class="fas fa-shopping-cart fa-5x"></i> </div>
                    <div class="col">
                        <a href="commandes.php"><span style="font-size: 20px; font-weight: bolder;">COMMANDES</span></a><br><br>
                        <span class="stat_nbr"><?= $com_nbr ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4" style="padding: 20px;text-align: center;">
            <div class=" stat">
                <div class="row ">
                    <div class="col" style="padding-top: 4px;"><i class="fas fa-dolly fa-5x"></i> </div>
                    <div class="col">
                        <a href="articles.php"><span style="font-size: 20px; font-weight: bolder;">ARTICLES</span></a><br><br>
                        <span class="stat_nbr"><?= $art_nbr ?></span>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-6">
            <canvas id="myChart" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Chiffre d'affaire par </b> articles
            </div>
        </div>
        <div class="col-sm-6">
            <canvas id="myChart2" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Quantité par </b> articles
            </div>
        </div>
        <div class="col-sm-6">
            <canvas id="myChart3" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Chiffre d'affaire par  </b> clients
            </div>
        </div>
        <div class="col-sm-6">
            <canvas id="myChart4" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Quantité par </b> clients
            </div>
        </div>
        <div class="col-sm-6">
            <canvas id="myChart6" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Chiffre d'affaire par  </b> mois
            </div>
        </div>
        <div class="col-sm-6">
            <canvas id="myChart5" width="100%" ></canvas>
            <div class="alert alert-primary text-center" role="alert">
                <b>Quantité par </b> mois
            </div>
        </div>
    </div>
</div>
</section>
<?php

function getArrayForJS($tabs, $champ, $sep = "") {
    $labels = "";
    foreach ($tabs as $key => $tab) {
        if ($key + 1 != count($tabs))
            $labels .= "$sep" . $tab[$champ] . "$sep,";
        else
            $labels .= "$sep" . $tab[$champ] . "$sep";
    }
    return "[".$labels."]";
}


$labels_arts = getArrayForJS($art_com, "DESI_ART", "'");
$CHIF_af = getArrayForJS($art_com, "TOTAL");
$QTE_ART = getArrayForJS($art_com, "NBR_QTE");

$label_cl=getArrayForJS($clients, "NOM_CL", "'");
$cl_chif_aff=getArrayForJS($clients, "TOTAL");
$cl_qte_art=getArrayForJS($clients, "NBR_QTE");


$label_month=getArrayForJS($chiffre_affaire, "month", "'");
$month_chif_aff=getArrayForJS($chiffre_affaire, "TOTAL");
$month_qte_art=getArrayForJS($chiffre_affaire, "NBR_QTE");
        
?>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $labels_arts ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $CHIF_af ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?= $labels_arts ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $QTE_ART ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx3 = document.getElementById('myChart3').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'polarArea',
        data: {
            labels: <?= $label_cl ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $cl_chif_aff ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx4 = document.getElementById('myChart4').getContext('2d');
    const myChart4 = new Chart(ctx4, {
        type: 'polarArea',
        data: {
            labels: <?= $label_cl ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $cl_qte_art ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    const ctx5 = document.getElementById('myChart5').getContext('2d');
    const myChart5 = new Chart(ctx5, {
        type: 'line',
        data: {
            labels: <?= $label_month ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $month_qte_art ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx6 = document.getElementById('myChart6').getContext('2d');
    const myChart6 = new Chart(ctx6, {
        type: 'line',
        data: {
            labels: <?= $label_month ?>,
            datasets: [{
                    label: '# of Votes',
                    data: <?= $month_chif_aff ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php
include 'footer.php';
?>  

