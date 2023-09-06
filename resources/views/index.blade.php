<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="styles/style.css">
    <title>Tree_Of_Categories</title>
</head>
<body>
    <div class="container" id="container"></div> 

    <script>
        var categoryId;
        var categories = @JSON($categories);
        var selects = [];
        function createSelect(response, parentCategory){
                var container = document.getElementById('container');
                var newSelectBox = document.createElement("select");
                var disableOption = document.createElement('option');
                disableOption.textContent = 'Choose Category';
                disableOption.selected = true;
                disableOption.disabled = true;
                newSelectBox.appendChild(disableOption);
                newSelectBox.setAttribute('parentCategory', parentCategory)
                for (var i = 0; i < response.length; i++) {
                    var sub = response[i];
                    var option = document.createElement('option');
                    option.class = "categories";
                    option.value = sub.id;
                    option.textContent = sub.name;
                    newSelectBox.appendChild(option);
                    }
                    container.appendChild(newSelectBox);
                    selects.push(newSelectBox);
                    newSelectBox.addEventListener('change', (e) => addSubCategory(e.target.value, parentCategory));


                    return newSelectBox;
            }
        createSelect(categories, null);
        function addSubCategory(categoryId, parentCategoryId) {
            // console.log(categoryId);
            // console.log(parentCategoryId);
            let cutSelectIndex = 99;
            for(let i = 0; i < selects.length; i++){
                const select = selects[i];
                console.log(parentCategoryId, select.getAttribute('parentCategory'));
                if(select.getAttribute('parentCategory') == (parentCategoryId??'null')){
                    cutSelectIndex = i;
                    break;
                }
            }
            for(let i = 0; i < selects.length; i++){
                const select = selects[i];
                if(i > cutSelectIndex){
                    select.remove();
                }
            }
            console.log(cutSelectIndex);
            fetch('http://localhost:8000/category/' + categoryId, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(response => {
                console.log(JSON.stringify(response))
                fetch('http://localhost:8000/category/' + categoryId, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(response => {
                console.log(JSON.stringify(response))
                createSelect(response,categoryId);
            })
            })

        }
        
    </script>
</body>
</html>