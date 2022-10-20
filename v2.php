<?php
ini_set('max_execution_time', '4500');

$project_array = [
    '384641',
    '216548',
    '198446'
];

// for ($pageIndex = 0; $pageIndex <= 65; $pageIndex++) {

//     $url = 'https://manage.build.superagency.io/me/manage/rr/?action=list-projects&page=' . $pageIndex . '&_csrfToken=B5XPXf-oPhIJr-lEvy6P&rnd=1666245947367';
//     $ch = curl_init($url);

//     $header = array();

//     $header[] = 'cookie: _fbp=fb.1.1660494776956.630408848; ajs_anonymous_id=fc74e443-35e5-4a46-899a-0f251f4dee66; _ga_DWD1QP3PLZ=GS1.1.1660973189.2.1.1660973218.0.0.0; _ga_V59GL7ENCM=GS1.1.1663496329.1.1.1663496381.0.0.0; _ga_ECL2WDPK7W=GS1.1.1665151138.18.0.1665151138.0.0.0; _gcl_au=1.1.1115403636.1666007529; _ga=GA1.2.1642046817.1660918505; site_remember_zmmm=Vzys39G165iwHM37%3Am9LfuPfOpSK4mJAJ; INGRESSCOOKIE=5F9D60CACDCBE11BED7BC320F4B2B2C3; _csrfToken=B5XPXf-oPhIJr-lEvy6P; intercom-session-wqtk8x2o=RHYxNnZWUGlVWjN0MTZta3Z4UGJXeXQ4OCtWWHdpOGhDN3lRMDlBOUJYN2pmWDVnZTluUXRWM09lU3RvTTJxNC0tejkrN05jMXpDM1JOaURNRUVXdlhFdz09--120157938f88e71e00223375709845bad834a45e';

//     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     $data = curl_exec($ch);
//     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     echo "<pre>";

//     if ($httpcode == 200 || $httpcode == 201) {
//         $projects = json_decode($data, true);
//         foreach ($projects['data']['items'] as $project) {
//             array_push($project_array, $project['id']);
//         }
//     }

//     curl_close($ch);
// }

$websites_array = [
    'jazzyparr.com',
    'run2nowhere.co.za',
    //  'thehairboutiqueco.com.au',
    'bwanamedia.co.za',
    'frenchroyaltybulldogs.com.au',
    'teendiewater.com',
    'battery-tec.co.za',
    //   'comcat.co.za',
    //   'supercloner.io',
    '3rmobile.co.za',
    //  'inductionafrica.co.za',
    //   'ghm.co.za',
    // 'themarketintellect.co.za',
    'dekleinewerf.co.za',
    'sophiaguesthouse.co.za',
    // 'besalt.co.za',
    // 'milarepairs.com',
    // 'mymarketing.store',
    'getseas.co.za',
    'seewhycutsbarber.com',
    'tulummuaythai.info',
    'roguesraw.com.au',
    'strickland.co.za',
    // 'funnelandconversion.com',
    'thecwi.ca',
    // 'giordano.build.superagency.io',
    'progiordanobruno.org.mx',
];
$website_to_download = [];


// foreach ($project_array as $proj) {
//     $websites = "https://manage.build.superagency.io/me/manage/rr/?action=list-websites&page=0&projectId='.$proj.'&_csrfToken=FRDz3G-lCDOj6-EwFH6K&rnd=1666271456271";
//     $ch = curl_init($websites);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $header = array();
//     $header[] = 'authority: manage.build.superagency.io';
//     $header[] = 'cookie: cookie: _fbp=fb.1.1663600505558.323104561; ajs_anonymous_id=23396aa1-6654-4c89-860a-ff428bfe0d3e; _ga_ECL2WDPK7W=GS1.1.1664950094.4.0.1664950095.0.0.0; _ga=GA1.2.280471248.1664794253; _gid=GA1.2.529480660.1666009212; _gcl_au=1.1.1183952686.1666009212; site_remember_zmmm=YD33KmCXDg9bGfqQ:pxfrHqhvmAxZdAu0; INGRESSCOOKIE=042059F891C343B25996A749109F322A; _csrfToken=iEBQi5-JfZlyS-51ZZzA; intercom-session-wqtk8x2o=ZzZqMnRkdkJ5MnAyYXFueFBaR3RkcTdHWktYUVZmRGpEUmZnMENtNzdXSGQrZDVha3dPYnN3ZTdMcENkTnZzay0tZnhYcUhIL0pkQXBINzJoOHVjNjg0UT09--4f78ca74f67081df9666c9494aa89ed8c273a57f';
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//     $data1 = curl_exec($ch);
//     $website_data = json_decode($data1, true);
//     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//     if (isset($website_data['data']['websites']['items'])) {
//         foreach ($website_data['data']['websites']['items'] as $website) {
//             if ($website['domain'] !== null or $website['domain'] !== '') {
//                 array_push($websites_array, $website['domain']);
//             }
//         }
//     }
//     curl_close($ch);
// }

// echo "<pre>";
// print_r($websites_array);
// exit;

foreach ($websites_array as $website) {
    $website_to_download[] = getReferer($website);
}


foreach ($website_to_download as $wd) {
    $referer = $wd['referer'];
    $website_to_scrap = $wd['website'];
    $website_domain = $wd['domain'];

    if (!is_dir($website_domain)) {
        mkdir($website_domain);
    }

    $sitemap = file_get_contents($website_to_scrap . '/sitemap.xml');

    $xml = simplexml_load_string($sitemap);


    // start creating a sitemap in website folder 

    $file_sitemap = fopen($website_domain . "/sitemap.xml", "w") or die("Unable to open file!");

    fwrite($file_sitemap, $sitemap);
    fclose($file_sitemap);

    // end creating a sitemap in website folder 

    // start creating a vercel.json in website folder 

    $file_vercel = fopen($website_domain . "/vercel.json", "w") or die("Unable to open file!");
    $vercel_content = '{
                        "cleanUrls": true
                   }';
    fwrite($file_vercel, $vercel_content);
    fclose($file_vercel);

    // end creating a vercel.json in website folder 

    // start creating a robots.txt in website folder 
    $robot_content = file_get_contents($website_to_scrap . '/robots.txt');
    $file_robot = fopen($website_domain . "/robots.txt", "w") or die("Unable to open file!");
    fwrite($file_robot, $robot_content);
    fclose($file_robot);
    // end creating a robots.txt in website folder 

    foreach ($xml->url as $urlElement) {
        // get properties
        $url = $urlElement->loc;
        $pagename = explode($website_to_scrap, $url);

        if (isset($pagename[1])) {
            $path_structure = explode('/', $pagename[1]);
            if (count($path_structure) == 1) {
                $page_name =  'index.html';
            } elseif (count($path_structure) == 2) {
                $page_name =  $path_structure[1] . '.html';
            } else {
                if (!is_dir($website_domain . '/' . $path_structure[1])) {
                    mkdir($website_domain . '/' . $path_structure[1]);
                }
                $page_name =  $path_structure[2] . '.html';
            }
        }

        $ch = curl_init($url);

        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Referer: ' . $referer;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);

        if (isset($path_structure[2])) {
            $myfile = fopen($website_domain . "/" . $path_structure[1] . "/" . $page_name, "w") or die("Unable to open file!");
        } else {
            $myfile = fopen($website_domain . "/" . $page_name, "w") or die("Unable to open file!");
        }

        fwrite($myfile, $data);
        fclose($myfile);
    }
}

function getReferer($website)
{
    $website_url = $website . '/login';
    $ch = curl_init($website_url);
    curl_setopt($ch, CURLOPT_URL, $website_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $html = curl_exec($ch);
    $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $referer = str_replace("/login", "", $redirectedUrl);

    $data = array(
        'domain' => $website,
        'website' => 'https://' . $website,
        'referer' => $referer
    );

    //  $website_to_download[] = $data;

    curl_close($ch);
    return $data;
}

exit;
