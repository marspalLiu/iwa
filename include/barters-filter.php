
<div class="filter">
    <div class="filter-content">
    
            <select id = "category_select">
                <option value = "all">All</option>
                <?php
                    $rows = $db->query("SELECT * from `categories`");
                    foreach ($rows as $row){ 
                ?>
                <option value = <?= $row["category_id"]?>><?= $row["category_name"]?></option>
                <?php 
                    }
                ?>
            </select>    
    
      
            <select id = "date_sort_select">
                <option value = DESC> newer</option>
                <option value = ASC> older</option> 
            </select>
               
            <div class="search">
                <input id = "search_input" type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                        Search
                </button>
            </div>

            
    </div>
</div>



