<?php

// Function to generate pagination links
function pagination($query,$per_page=10,$page=1,$url='?')
{
    global $conDB;

    // Count the total number of records
    $query = "SELECT COUNT(*) as `id` FROM {$query}"; // Query to count the total number of records

    $row = mysqli_fetch_array(mysqli_query($conDB,$query));// Execute the query and fetch the result

    $total = $row['id']; // Get the total count of records
    $adjacents = "2"; // The number of adjacent pages to show

    $prevlabel = "&lsaquo; Prev";// Label for the previous page link
    $nextlabel = "Next &rsaquo;"; // Label for the next page link
    $lastlabel = "Last &rsaquo;&rsaquo;"; // Label for the last page link


    $page = ($page == 0 ? 1 : $page); // Ensure that the page number is not zero
    $start = ($page - 1) * $per_page; //starting index of records for the current page



    $prev = $page - 1;// Calculate the previous page number
    $next = $page + 1;// Calculate the next page number

    $lastpage = ceil($total/$per_page); // Calculate the last page number

    $lpm1 = $lastpage - 1; // //last page minus 1

    $pagination = ""; // Variable to store the generated pagination links
    if($lastpage > 1){
        $pagination .= "<ul class='pagination'>";
        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";


        if ($lastpage < 7 + ($adjacents * 2)){
            // If there are not enough pages to create ellipsis and show all pages
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
            }



        } elseif($lastpage > 5 + ($adjacents * 2)){
            // If there are enough pages to create ellipsis and show a subset of pages

            if($page < 1 + ($adjacents * 2)) {
                // If the current page is close to the beginning

                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }


                $pagination.= "<li class='dot'>...</li>";// Add ellipsis
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>"; // Generate a link for the second-to-last page
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>"; // Generate a link for the last page


            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                 // If the current page is in the middle

                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";

            } else {

                // If the current page is close to the end

                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";
                }
            }
        }

            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }

        $pagination.= "</ul>";
    }

    return $pagination; // Return the generated pagination links
}





 ?>
