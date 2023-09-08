class TabManager 
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs() 
    {
        const tabElements = document.querySelectorAll('.cat');
        tabElements.forEach(tabName => {
            tabName.addEventListener('click', () => {
                tabElements.forEach(tab => {
                    tab.classList.remove('active');
                });
                tabName.classList.add('active');
                this.headerTabClick(tabName.id);
            });
        });
    }

    headerTabClick(tabId)
    {
        const boxContent = document.querySelector('.box-content');
        // let content = '';
            const tableName = tabId.toUpperCase();
            const buttonText = `ADD ${tableName}`;
            const buttonText1 = `UPDATE ${tableName}`;
            const content = `
               <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 d-flex flex-column justify-content-center align-items-left adding-category">
                            <h4 class="content-header">ADD ${tableName}</h4>
                            <div class="form-group">
                                <label for="slno">SL.NO</label>
                                <input type="text" class="form-control" id="${tabId}-slno" readonly>
                            </div>
                            <div class="form-group">
                                <label for="slno">${tableName} NAME</label>
                                <input type="text" class="form-control nameFeild" id="${tabId}-name">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-info" id="submitBtn">${buttonText}</button>
                                <button class="btn btn-info" id="updateBtn" style="display:none;">${buttonText1}</button>
                            </div>
                            <div id="response"></div>
                        </div>
                        <div class="col-md-9">
                            <div class="table-container">
                                <table id="${tabId}-dataTable"  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL.NO</th>
                                            <th>${tableName} NAME</th>
                                            <th>EDIT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="${tabId}-tbody">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            boxContent.innerHTML = content;
            this.fetchAndPopulateData(tabId);

            const submitButton = document.getElementById('submitBtn');
            submitButton.addEventListener('click', () => 
            {
                this.submitData(tabId,0);
            });

            const updateButton = document.getElementById('updateBtn');
            updateButton.addEventListener('click', () => 
            {
                this.submitData(tabId,1);
            });

            document.addEventListener('click', event => 
            {
                if(event.target.classList.contains('edit-button'))
                {
                    $('#submitBtn').hide();
                    $('#updateBtn').show();
                    const row = event.target.closest('tr');
                    const slno = row.cells[0].textContent;
                    const name = row.cells[1].textContent;
                    const cat_id = row.querySelector('.edit-button').getAttribute('data-id');
                    const rowData={
                        "slno":slno,
                        'name':name,
                        'id' : cat_id
                    }
                    this.EditForm(tabId,rowData);
                }else if(event.target.classList.contains('delete-button')) 
                {
                    const row = event.target.closest('tr');
                    const rowData = getDataFromTableRow(row);
                }
            });
        if(tabId != 'gst')
        {
            $('.nameFeild').keypress(function(event)
            {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if ((keycode < 47 || keycode > 57))
                {
                    return true;
                }else
                {
                    return false;
                }
            });
        }
    }

    async fetchAndPopulateData(tabId) 
    {
        try{
            const response = await fetch(`ajax/fetch_master.php?tabId=${tabId}`);
            if(!response.ok)
            {
                throw new Error('Network Response Was Not Ok');
            }
            const data = await response.json();
            const tbodyElement = document.getElementById(`${tabId}-tbody`);
            tbodyElement.innerHTML = '';
            if (tabId === 'category') 
            {
                data.forEach(rowData => {
                    const rowHTML = `<tr>
                                        <td>${rowData.cat_id}</td>
                                        <td>${rowData.cateName}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.cat_id}">Edit</button>
                                            <!-- <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.cat_id}">Delete</button>-->
                                        </td>
                                    </tr>`;
                    tbodyElement.innerHTML += rowHTML;
                });
            }else if(tabId === 'flavor') 
            {
                data.forEach(rowData => 
                {
                    const rowHTML = `<tr>
                                        <td>${rowData.id}</td>
                                        <td>${rowData.flavorName}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                          <!--  <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                        </td>
                                    </tr>`;
                    tbodyElement.innerHTML += rowHTML;
                });
            }else if(tabId=== 'brand')
            {
                data.forEach(rowData => 
                    {
                        const rowHTML = `<tr>
                                            <td>${rowData.id}</td>
                                            <td>${rowData.brandName}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                              <!--  <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                            </td>
                                        </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                    });
            }
            else if(tabId=== 'gst')
            {
                data.forEach(rowData => 
                    {
                        const rowHTML = `<tr>
                                            <td>${rowData.id}</td>
                                            <td>${rowData.slab}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                               <!-- <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                            </td>
                                        </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                    });
            }else if(tabId=== 'location')
            {
                data.forEach(rowData => 
                    {
                        const rowHTML = `<tr>
                                            <td>${rowData.id}</td>
                                            <td>${rowData.location}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                              <!--  <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                            </td>
                                        </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                    });
            }
            else if(tabId=== 'unit')
            {
                data.forEach(rowData => 
                    {
                        const rowHTML = `<tr>
                                            <td>${rowData.id}</td>
                                            <td>${rowData.unitName}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                              <!--  <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                            </td>
                                        </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                    });
            }
            // const data1=$(`#${tabId}-dataTable`).DataTable();

            const maxSlno = await this.fetchMaxSlno(tabId);
            const slnoInput = document.getElementById(`${tabId}-slno`);
            if (slnoInput) {
                slnoInput.value = maxSlno;
            }
        }
        catch (error)
        {
            console.log('Error Fetching Data:',error);
        }
    }

    async fetchMaxSlno(tabId) 
    {
        try {
            const response = await fetch(`ajax/fetch_master.php?maxslno=${tabId}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data.maxSlno;
        } catch (error) 
        {
            console.error('Error fetching max slno:', error);
            return 0;
        }
    }

    submitData(tabId,status)
    {
        const vm=this;
        const tableName = tabId.toUpperCase();
        let slnoInput = document.getElementById(`${tabId}-slno`);
        let nameInput = document.getElementById(`${tabId}-name`);
        // const submitButton = document.querySelector('.btn-info');
        if(nameInput.value=='')
        {
            // console.log('Please Fill Feilds');
            nameInput.style.border = '1px solid red';
            setTimeout(function() {
                nameInput.style.border = '';
            }, 2000); 
            return;
        }
        const data = {
            slno: slnoInput.value,
            name: nameInput.value
        };  

        // submitButton.disabled = true;

        let log=$.ajax({
            type: 'POST',
            url: 'ajax/submit_master.php',
            data: { tabId, data, status },
            dataType: 'json',
            success: async function(response) 
            {
                $('#response').html(response.message);
                setTimeout(function() 
                {
                    $('#response').html('');    
                }, 3000);
                if(status=1)
                {
                    $('#submitBtn').show();
                    $('#updateBtn').hide();
                }
                nameInput.value='';
                await vm.fetchAndPopulateData(tabId);
            },
            error: function(error) 
            {
                console.error('Error submitting data:', error);
            }
        });
    }

    EditForm(tabId, rowData) 
    {
        const nameInput = document.getElementById(`${tabId}-name`);
        const slnoInput = document.getElementById(`${tabId}-slno`);
    
        if (nameInput && slnoInput) 
        {
            nameInput.value = rowData.name;
            slnoInput.value = rowData.slno;
        }
    }
}

class HeaderTab
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs() 
    {
        const headerElements = document.querySelectorAll('.list-group-item');
        headerElements.forEach(tab => {
          tab.addEventListener('click', () => this.handleTabClick(tab.id));
        });

        document.addEventListener('paste', (event) => {
            if (event.target.tagName === 'INPUT') {
                event.preventDefault();
            }
        });
    }

    handleTabClick(tabId) 
    {
        if(tabId === "home") 
        {
          this.navigateToPage("home.php");
        }
        else if(tabId === "master") 
        {
          this.navigateToPage("master.php");
        }else if(tabId === "item") 
        {
          this.navigateToPage("item.php");
        }else if(tabId === "vendor") 
        {
          this.navigateToPage("vendor.php");
        }
        else if(tabId === "pur") 
        {
          this.navigateToPage("purchase.php");
        }
        else if(tabId === "stock") 
        {
          this.navigateToPage("stock.php");
        }
        else if(tabId === "sell") 
        {
          this.navigateToPage("sell.php");
        }
        else if(tabId === "profit") 
        {
          this.navigateToPage("profit.php");
        }
    }
    navigateToPage(pageUrl)
    {
        window.location.href = pageUrl;
    }
}

class ItemTab
{
    constructor()
    {
        this.dropdowns = [
            { id: 'category', tabId: 'category' },
            { id: 'brand', tabId: 'brand' },
            // { id: 'flavor', tabId: 'flavor' },
            // { id: 'unit', tabId: 'unit' },
            { id: 'categoryFilter', tabId: 'category' },
        ];
    }
    
    fetchData()
    {
        this.dropdowns.forEach(dropdown =>{
            $.ajax({
                url: 'ajax/fetch_master.php',
                type: 'GET',
                data: {
                    tabId: dropdown.tabId
                },
                success: function (response) 
                {
                    var data = JSON.parse(response);
                    var dropdownElement = $('#' + dropdown.id);
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));
                    $.each(data, function (index, item) 
                    {
                        if(dropdown.id=='category')
                        {
                            dropdownElement.append($('<option>').text(item.cateName).val(item.cateName));
                        }else if(dropdown.id=='brand')
                        {
                            dropdownElement.append($('<option>').text(item.brandName).val(item.brandName));
                        }
                        // else if(dropdown.id=='flavor')
                        // {
                        //     dropdownElement.append($('<option>').text(item.flavorName).val(item.flavorName));
                        // }
                        // else if(dropdown.id=='unit')
                        // {
                        //     dropdownElement.append($('<option>').text(item.unitName).val(item.unitName));
                        // }
                        else if(dropdown.id=='categoryFilter')
                        {
                            dropdownElement.append($('<option>').text(item.cateName).val(item.cateName));
                        }
                    });
                }
            });
        });
        const vm=this;
        const submitButton = document.getElementById('addItem');
        const updateButton = document.getElementById('updateItem');
        submitButton.addEventListener('click', () => 
        {
            this.submitData(0)
        });
        updateButton.addEventListener('click', () => 
        {
            this.submitData(1)
        });


        this.fetchItems();

        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            if (selectedCategory === '') 
            {
                $('#itemTableBoady tr').show();
            }else 
            {
                $('#itemTableBoady tr').hide();
                $('#itemTableBoady tr').each(function() 
                {
                    if ($(this).find('td:nth-child(2)').text() === selectedCategory) {
                        $(this).show();
                    }
                });
            }
        });

        const toggleButton = document.getElementById('toggleRows');
        const hiddenRows = document.querySelectorAll('.hidden-rows');
        hiddenRows.forEach(row => {
            row.classList.toggle('d-none');
        });
        toggleButton.addEventListener('click', () => {
            hiddenRows.forEach(row => {
                row.classList.toggle('d-none');
            });
        });

        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('edit-button'))
            {
                const areRowsHidden = hiddenRows[0].classList.contains('d-none');
                if (areRowsHidden) 
                {
                    toggleButton.click();
                }
                $('#addItem').hide();
                $('#updateItem').show();
                const row = event.target.closest('tr');
                const slno = row.cells[0].textContent;
                const category = row.cells[1].textContent;
                const brand = row.cells[2].textContent;
                const product = row.cells[3].textContent;
                // const flavor = row.cells[4].textContent;
                // const unit = row.cells[5].textContent;
                const item_code = row.cells[4].textContent;
                const cat_id = row.querySelector('.edit-button').getAttribute('data-id');
                const rowData={
                    'slno':slno,
                    'category':category,
                    'brand':brand,
                    'product':product,
                    // 'flavor':flavor,
                    // 'unit':unit,
                    'item_code':item_code,
                    'id' : cat_id
                }
                this.EditForm(rowData);
            }
        });
    }
    fetchItems()
    {
        let log=$.ajax({
            url:'ajax/fetch_master.php',
            type:'GET',
            dataType:'json',
            data:{item:'fetch_items'},
            success:function(response)
            {
                const tbodyElement = document.getElementById('itemTableBoady');
                tbodyElement.innerHTML = '';
                response.forEach(rowData => 
                {
                    const rowHTML = `<tr>
                                        <td>${rowData.id}</td>
                                        <td>${rowData.category}</td>
                                        <td>${rowData.brand}</td>
                                        <td>${rowData.product}</td>
                                        <td>${rowData.item_code}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                           <!-- <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                        </td>
                                    </tr>`;
                    tbodyElement.innerHTML += rowHTML;
                });

            }
        });
    }

    submitData(value)
    {
        const vm=this;
        var slno=0;
        if(value==1)
        {
            slno=$('#slno').val();
        }
        // return;
        var cate=$('#category').val();
        var brand=$('#brand').val();
        // var flavor=$('#flavor').val();
        var product=$('#product').val();
        // var unit=$('#unit').val();
        var item_code=$('#item_code').val();

        var feilds=['#category','#brand','#product','#item_code'];
        for(var i=0;i<feilds.length;i++)
        {
                if($(feilds[i]).val() == '')
                {
                    $(feilds[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(feilds[i]).css("border","");
                }
        }
            let log= $.ajax({
                url:'ajax/submit_master.php',
                type:'post',
                dataType:'json',
                data:{
                    cate:cate,
                    brand:brand,
                    // flavor:flavor,
                    product:product,
                    // unni:unit,
                    item_code:item_code,
                    slno:slno,
                    value:value
                },
                success: function(response)
                {
                    $('#response').html(response.message);
                    vm.fetchItems();
                    setTimeout(function() 
                    {
                        $('#response').html('');    
                    }, 3000);
                    if(response.message=='Item Updated successfully')
                    {
                        $('#addvendor').show();
                        $('#updatevendor').hide();
                        for(var i=0;i<feilds.length;i++)
                        {
                            $(feilds[i]).val('')
                        }
                    }else if(response.message=='Item submitted successfully')
                    {
                        for(var i=0;i<feilds.length;i++)
                        {
                            $(feilds[i]).val('')
                        }
                    }
                }
        });
    }
    EditForm(rowData)
    {
        $('#slno').val(rowData.slno);
        $('#category').val(rowData.category);
        $('#brand').val(rowData.brand);
        // $('#flavor').val(rowData.flavor);
        $('#product').val(rowData.product);
        // $('#unit').val(rowData.unit);
        $('#item_code').val(rowData.item_code);
    }

}

class vendorReg
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs() 
    {
        // const vm=this;
        // const submitButton = document.getElementById('addvendor');
        // const updateButton = document.getElementById('updatevendor');
        // submitButton.addEventListener('click', () => 
        // {
        //     vm.submitData(0)
        // });
        // updateButton.addEventListener('click', () => 
        // {
        //     vm.submitData(1)
        // });
    }
    submitData(value)
    {
        const vm=this;
        var slno=0;
        if(value != 0)
        {
            slno=$('#slno').val();
        }
        var venName=$('#venName').val();
        var venGst=$('#venGst').val();
        var venMobile=$('#venMobile').val();
        var venAdds=$('#venAdds').val();
        var feilds=['#venName','#venMobile','#venAdds'];
        for(var i=0;i<feilds.length;i++)
        {
            if($(feilds[i]).val() == '')
            {
                $(feilds[i]).css("border", "1px solid red");
                return;
            }else
            {
                $(feilds[i]).css("border","");
            }
        }
        if(venMobile.length != 10)
        {
            $('#venMobile').css("border", "1px solid red");
            setTimeout(function()
            {
                $('#venMobile').css("border", "");
            }, 3000);
            return;
        }
        
        let log= $.ajax({
            url:'ajax/submit_master.php',
            type:'post',
            dataType:'json',
            data:{
                venName:venName,
                venGst:venGst,
                venMobile:venMobile,
                venAdds:venAdds,
                slno:slno,
                value:value
            },
            success: function(response)
            {
                var check='vendor';
                $('#response').html(response.message);
                vm.fetchVendors(check);
                setTimeout(function() 
                {
                    $('#response').html('');    
                }, 3000);
                if(response.message=='Vendor Updated successfully')
                {
                    $('#addvendor').show();
                    $('#updatevendor').hide();
                    for(var i=0;i<feilds.length;i++)
                    {
                        $(feilds[i]).val('')
                    }
                }else if(response.message=='Vendor inserted successfully')
                {
                    for(var i=0;i<feilds.length;i++)
                    {
                        $(feilds[i]).val('')
                    }
                }
            }
        });
    }
    fetchVendors(check)
    {
        let log=$.ajax({
            url:'ajax/fetch_master.php',
            type:'GET',
            dataType:'json',
            data:{item:'fetch_vendors'},
            success:function(response)
            {
                if(check=='vendor')
                {
                    const tbodyElement = document.getElementById('itemTableBoady');
                    tbodyElement.innerHTML = '';
                    response.forEach(rowData => 
                    {
                        const rowHTML = `<tr>
                                            <td>${rowData.id}</td>
                                            <td>${rowData.venName}</td>
                                            <td>${rowData.venGst}</td>
                                            <td>${rowData.venMobile}</td>
                                            <td>${rowData.venAdds}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                               <!-- <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button> -->
                                            </td>
                                        </tr>`;
                            tbodyElement.innerHTML += rowHTML;
                    });
                }else if(check=='purchase')
                {
                    var dropdownElement = $('#venName');
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));
                    $.each(response, function (index, item) 
                    {
                        dropdownElement.append($('<option>').text(item.venName).val(item.venName));
                    });
                }
            }
        });

        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('edit-button'))
            {
                const vm=this;
                $('#addvendor').hide();
                $('#updatevendor').show();
                const row = event.target.closest('tr');
                const slno = row.cells[0].textContent;
                const venName = row.cells[1].textContent;
                const venGst = row.cells[2].textContent;
                const venMobile = row.cells[3].textContent;
                const venAdds = row.cells[4].textContent;
                const cat_id = row.querySelector('.edit-button').getAttribute('data-id');

                const rowData={
                    'slno':slno,
                    'venName':venName,
                    'venGst':venGst,
                    'venMobile':venMobile,
                    'venAdds':venAdds,
                    'id' : cat_id
                }
                $('#slno').val(rowData.slno);
                $('#venName').val(rowData.venName);
                $('#venGst').val(rowData.venGst);
                $('#venMobile').val(rowData.venMobile);
                $('#venAdds').val(rowData.venAdds);
            }
        });

        $('#venName').keypress(function(event)
        {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if ((keycode < 47 || keycode > 57))
            {
                return true;
            }else
            {
                return false;   
            }
        });
        $('#venMobile').keypress(function(event)
        {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if ((keycode < 47 || keycode > 57))
            {
                return false;
            }else
            {
                return true;   
            }
        });
    }
}


class Purchase {
    constructor()
    {
        this.dropdowns = [
            { id: 'category', purchase: 'category' },
            { id: 'location', purchase: 'location' },
            { id: 'gst', purchase: 'gst' },
            { id: 'flavor', purchase: 'flavor' },
            { id: 'unit', purchase: 'unit' },
        ];

        this.initializeTabs();
        this.attachDeleteButtonHandlers();
    }

    initializeTabs() 
    {
        const vm=this;
        const tabElements = document.querySelectorAll('.cat');
        tabElements.forEach(tabName => {
            tabName.addEventListener('click', () => {
                tabElements.forEach(tab => {
                    tab.classList.remove('active');
                });
                tabName.classList.add('active');
                if(tabName.id=='viewPur')
                {   
                    $('#addPurchaseData').hide();
                    $('#viewpurchaseData').show();
                    vm.viewPurchaseRecord(0);
                }else if(tabName.id=='addPur')
                {
                    $('#viewpurchaseData').hide();
                    $('#addPurchaseData').show();
                }
            });
        });

        const search=document.getElementById('search');
        search.addEventListener('click',() => {
            vm.viewPurchaseRecord(1);
        });

        const refresh=document.getElementById('refresh');
        refresh.addEventListener('click',() => {
            vm.viewPurchaseRecord(0);
        });

        //categeroy and gst 
        this.dropdowns.forEach(dropdown =>{
            $.ajax({
                url: 'ajax/fetch_master.php',
                type: 'GET',
                data: {
                    purchase: dropdown.purchase
                },
                success: function (response) 
                {
                    var data = JSON.parse(response);
                    var dropdownElement = $('#' + dropdown.purchase);
                        dropdownElement.empty();
                        dropdownElement.append($('<option>').text('Select').val(''));
                        $.each(data, function (index, item) 
                        {
                            if(dropdown.id=='category')
                            {
                                dropdownElement.append($('<option>').text(item.category).val(item.category));
                            }else if(dropdown.id=='location')
                            {
                                dropdownElement.append($('<option>').text(item.location).val(item.location));
                            }else if(dropdown.id=='gst')
                            {
                                dropdownElement.append($('<option>').text(item.slab).val(item.slab));
                            }else if(dropdown.id=='flavor')
                            {
                                dropdownElement.append($('<option>').text(item.flavorName).val(item.flavorName));
                            }else if(dropdown.id=='unit')
                            {
                                dropdownElement.append($('<option>').text(item.unitName).val(item.unitName));
                            }
                        });
                }
            });
        });
        //onchange
        const categories = document.querySelectorAll('#category, #brand, #product');
        categories.forEach(category => {
            category.addEventListener('change', function(event)
            {
                let selectedValue = event.target.value;
                const categoryId = event.target.id;
                const status=0;
                if(!selectedValue)return;
                vm.fetchAllData(selectedValue, categoryId,status);
            });
        });

        const item_code = document.getElementById('item_code');
        item_code.addEventListener('input',function (event)
        {
            let selectedValue = event.target.value;
            const categoryId = event.target.id;
            const status=1;
            if(!selectedValue){return;}
            vm.fetchAllData(selectedValue, categoryId,status);
        });

        const totalPrice = document.getElementById('price');
        totalPrice.addEventListener('input',function (event)
        {
            const totalPriceValue = event.target.value;
            const gst = document.getElementById('gst').value;
            const qty = document.getElementById('qty').value;
            if(!gst && !qty){return}
            vm.priceCalculation(totalPriceValue,gst,qty)
        });

        const Quantity = document.getElementById('qty');
        Quantity.addEventListener('input',function (event)
        {
            const qty = event.target.value;
            const gst = document.getElementById('gst').value;
            const totalPriceValue = document.getElementById('price').value;
            if(!gst && !totalPriceValue){return}
            vm.priceCalculation(totalPriceValue,gst,qty)
        });

        const gstMain = document.getElementById('gst');
        gstMain.addEventListener('change',function(event)
        {
            const gst = event.target.value;
            const totalPriceValue = document.getElementById('price').value;
            const qty = document.getElementById('qty').value;
            if(!totalPriceValue && !qty){return}
            vm.priceCalculation(totalPriceValue,gst,qty)
        });

        $('#qty, #price, #mrpPrice, #salePrice').keypress(function(event)
        {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if ((keycode < 47 || keycode > 57))
            {
                return false;
            }else
            {
                return true;   
            }
        });

        //final Submit
        const submitPurchase = document.getElementById('submitPurchase');
        submitPurchase.addEventListener('click', (event) => 
        {
            this.submitData();
        });
        
        const cancelPurchase = document.getElementById('cancelPurchase');
        cancelPurchase.addEventListener('click', (event) => 
        {
            // this.cancelPurchase();
            let items = JSON.parse(localStorage.getItem('items'));
            localStorage.removeItem('items');
            const tableBody = document.getElementById('itemTableBoady');
            let totalAmount = 0;
            tableBody.innerHTML = '';
            vm.fetchItems();
        });
    }

    fetchAllData(selectedValue, categoryId,status)
    {
        var category= $('#category').val();
        var brand=$('#brand').val();
        var product= $('#product').val();
        // var flavor= $('#flavor').val();
        // var unit= $('#unit').val();

        var formData = new FormData();
        formData.append('id1', categoryId);
        $('#item_code').val('');
        if (categoryId == 'category') 
        {
            formData.append('category1', selectedValue);
        }
        else if (categoryId == 'brand')
        {
            formData.append('category1', category);
            formData.append('brand1', selectedValue);
        }
        else if(categoryId=='product')
        {
            formData.append('category1', category);
            formData.append('brand1', brand);
            formData.append('product1', selectedValue);

            var input=['#category','#brand','#product'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }
        }
        // else if(categoryId=='flavor')
        // {
        //     formData.append('category1', category);
        //     formData.append('brand1', brand);
        //     formData.append('product1', product);
        //     formData.append('flavor1', selectedValue);
        // }
        // else if(categoryId=='unit')
        // {
        //     formData.append('category1', category);
        //     formData.append('brand1', brand);
        //     formData.append('product1', product);
        //     formData.append('flavor1', flavor);
        //     formData.append('unit1', selectedValue);

            // var input=['#category','#brand','#product','#flavor','#unit'];
            // for(var i=0; i<input.length; i++)
            // {
            //     if($(input[i]).val() == '')
            //     {
            //         $(input[i]).css("border", "1px solid red");
            //         return;
            //     }else
            //     {
            //         $(input[i]).css("border","");
            //     }
            // }
        // }
        else if(categoryId=='item_code')
        {
            $('#item_code').val(selectedValue);
            formData.append('item_code1', selectedValue);
        }
        let log=$.ajax({
            url:'ajax/fetch_master.php',
            type :'POST',
            dataType:'json',
            data:formData,
            contentType: false,
            processData: false,
            success: function(response)
            {
                if(status==0)
                {
                    if (categoryId == 'category') 
                    {
                        var dropdownElement= $('#brand');
                    }
                    else if (categoryId == 'brand')
                    {
                        var dropdownElement= $('#product');
                    }
                    else if(categoryId=='product')
                    {
                        $.each(response, function (index, item)
                        {
                            $('#item_code').val(item.name);
                            return;
                        });
                        return;
                    }
                    // else if(categoryId=='flavor')
                    // {
                    //     var dropdownElement= $('#unit');
                    // }
                    // else if(categoryId=='unit')
                    // {
                       
                    // }
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));

                    $.each(response, function (index, item)
                    {
                        dropdownElement.append($('<option>').text(item.name).val(item.name));
                    });
                }
                else if(status==1)
                {
                    // console.log(status);
                    var dropdownElements = [
                        $('#brand'),$('#product'),$('#category')
                    ];
                    for(var i=0;i<dropdownElements.length;i++)
                    {
                        var dropdownElement=dropdownElements[i];
                        if(i!=2)
                        {
                            dropdownElement.empty();
                        }
                        var checkDuplicate = {};

                        $.each(response, function (index, item)
                        {
                            if(i==0)
                            {
                                if (!checkDuplicate[item.brand])
                                {
                                    checkDuplicate[item.brand] = true;
                                    dropdownElement.append($('<option>').text(item.brand).val(item.brand));
                                }
                            }else if(i==1)
                            {
                                if (!checkDuplicate[item.product]) 
                                {
                                    checkDuplicate[item.product] = true;
                                    dropdownElement.append($('<option>').text(item.product).val(item.product));
                                }
                            }else if(i==2)
                            {
                                $('#category').val(item.category);
                            }
                        });
                    }
                }
            }
        });
        // console.log(log);
    }
    priceCalculation(totalPriceValue,gst,qty)
    {
        var x=(gst/100)+1;
        var PerProductGSt=totalPriceValue/qty;
        var baseRate=PerProductGSt/x;   
        var gstPerProduct=PerProductGSt-baseRate;
        document.getElementById('gstPer').value = PerProductGSt.toFixed(2);
        document.getElementById('basePer').value = baseRate.toFixed(2);
    }
    Itemadd()
    {
        let item_code=$('#item_code').val();
        let category=$('#category').val();
        let brand=$('#brand').val();
        let product=$('#product').val();
        let flavor=$('#flavor').val();
        let unit=$('#unit').val();
        let location=$('#location').val();
        let gst=$('#gst').val();
        let expDate=$('#expDate').val();
        let qty=$('#qty').val();
        let price=$('#price').val();
        let gstPer=$('#gstPer').val();
        let basePer=$('#basePer').val();
        let mrpPrice=$('#mrpPrice').val();
        let salePrice=$('#salePrice').val();
        let unitQty=$('#unitQty').val();
        var input=['#category','#brand','#product','#flavor','#unit','#location','#expDate','#gst',,'#qty','#price','#mrpPrice','#salePrice','#unitQty'];
        for(let i=0; i<input.length; i++)
        {
            if($(input[i]).val() == '')
            {
                $(input[i]).css("border", "1px solid red");
                return;
            }else
            {
                $(input[i]).css("border","");
            }
        }

        let newItem = 
        {
            item_code: item_code,
            category: category,
            brand: brand,
            product: product,
            flavor: flavor,
            unit: unit,
            location: location,
            expDate:expDate,
            gst: gst,
            qty:qty,
            price:price,
            gstPer:gstPer,
            basePer:basePer,
            mrpPrice:mrpPrice,
            salePrice:salePrice,
            unitQty:unitQty,
        };

        let existingItems = localStorage.getItem('items');
        let itemsArray = existingItems ? JSON.parse(existingItems) : [];
        let itemExists = itemsArray.some(item => item.item_code === item_code);

        if (!itemExists) 
        {
            itemsArray.push(newItem);
            localStorage.setItem('items', JSON.stringify(itemsArray));
            this.fetchItems();
            var input1=['#flavor','#unit','#location','#expDate','#gst',,'#qty','#price','#mrpPrice','#salePrice','#unitQty',`#item_code`,`#gstPer`,`#basePer`];
            for(let i=0; i<input1.length; i++)
            {
                $(input1[i]).val('')
            }
        }
        else
        {
            // Handle case when item_code already exists
            console.log('Item with the same item_code already exists.');
            Swal.fire({
                icon: 'error',
                title: 'Item Code Exists',
                text: 'An item with the same item code already exists.',
            });
    
        }
    }

    fetchItems()
    {
            const items = JSON.parse(localStorage.getItem('items'));
            if (items !== null && Array.isArray(items))
            {
                const tableBody = document.getElementById('itemTableBoady');
                let totalAmount = 0;
                tableBody.innerHTML = '';
            
                items.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor}</td>
                        <td>${item.unit}-${item.unitQty}</td>
                        <td>${item.gst}</td>
                        <td>${item.qty}</td>
                        <td>${item.gstPer}</td>
                        <td>${item.basePer}</td>
                        <td>${item.mrpPrice}</td>
                        <td>${item.salePrice}</td>
                        <td>${item.price}</td>
                        <td>${item.expDate}</td>
                        <td><button class="btn btn-danger delete-button" data-index="${index}">Delete</button></td>
                    `;
                    tableBody.appendChild(row);
                });
                items.forEach(item => {
                    totalAmount += parseFloat(item.price); // Assuming "mrp" is a numeric value
                });
                const totalAmt = document.getElementById('totalAmt').value=totalAmount;
            }
    }

    attachDeleteButtonHandlers() {
        const tableBody = document.getElementById('itemTableBoady');
        tableBody.addEventListener('click', (event) => {
            if (event.target.classList.contains('delete-button')) {
                const index = event.target.getAttribute('data-index');
                this.deleteItem(index);
            }
        });
    }

    deleteItem(index) 
    {
        let items = JSON.parse(localStorage.getItem('items'));
        items.splice(index, 1);
        localStorage.setItem('items', JSON.stringify(items));
        this.fetchItems(); // Refresh the table after deletion
    }

    submitData()
    {
        let vm=this;
        let venName=$('#venName').val();
        let purDate=$('#purDate').val();
        let totalAmt=$('#totalAmt').val();
        var input=['#venName','#purDate','#totalAmt'];
        for(let i=0; i<input.length; i++)
        {
            if($(input[i]).val() == '')
            {
                $(input[i]).css("border", "1px solid red");
                return;
            }else
            {
                $(input[i]).css("border","");
            }
        }
        let items = JSON.parse(localStorage.getItem('items'));
        let log=$.ajax({
            url:'ajax/submit_master.php',
            type:'post',
            dataType:'json',
            data:{
                ven:venName,
                purDate:purDate,
                totalAmt:totalAmt,
                itemList :items,
            },
            success: function(response)
            {
                if(response.message=='Purchased successfully..')
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                      })
                    for(var i=0;i<input.length;i++)
                    {
                        if(i != 1)
                        {
                            $(input[i]).val('');
                        }
                    }
                    localStorage.removeItem('items');
                    const tableBody = document.getElementById('itemTableBoady');
                    let totalAmount = 0;
                    tableBody.innerHTML = '';
                    vm.fetchItems();
                }else
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                      })
                }
            }
        });
    }

    viewPurchaseRecord(sta)
    {
        if(sta==1)
        {
            var fromDate=$('#datefrom').val();
            var toDate=$('#dateto').val();
            var input=['#datefrom','#dateto'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }
        }else if(sta==0)
        {
            var fromDate='';
            var toDate='';
        }
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                purViewRecord:'purViewRecord',
                fromDate:fromDate,
                toDate:toDate,
                sta:sta,
            },
            dataType:'json',
            success: function (response) 
            {
                const tbodyElement = document.getElementById('viewPurchaseDataTable');
                tbodyElement.innerHTML = '';
                response.forEach(rowData => 
                {
                    const rowHTML = `<tr>
                                        <td>${rowData.id}</td>
                                        <td>${rowData.venName}</td>
                                        <td>${rowData.purchase_date}</td>
                                        <td>${rowData.totalamount}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary view-button" data-id="${rowData.id}">View</button>
                                        </td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });

        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('view-button'))
            {
                $('#dataTable1').hide();
                $('#dataTable2').show();
                const row = event.target.closest('tr');
                let cat_id = row.querySelector('.view-button').getAttribute('data-id');
                let log= $.ajax({
                    url: 'ajax/fetch_master.php',
                    type: 'GET',
                    data: {
                        purViewRecordItem:'purViewRecord',
                        pur_id:cat_id,
                    },
                    dataType:'json',
                    success: function (response) 
                    {
                        const tbodyElement = document.getElementById('purchaseItems');
                        tbodyElement.innerHTML = '';
                        response.forEach((item,index)=> 
                        {
                            const rowHTML = `<tr>
                                                <td>${index + 1}</td>
                                                <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor}</td>
                                                <td>${item.unit}-${item.unitQty}</td>
                                                <td>${item.gst}</td>
                                                <td>${item.qty}</td>
                                                <td>${item.gstprice}</td>
                                                <td>${item.baseprice}</td>
                                                <td>${item.mrpprice}</td>
                                                <td>${item.saleprice}</td>
                                                <td>${item.totalprice}</td>
                                                <td>${item.exp}</td>
                                            </tr>`;
                                tbodyElement.innerHTML += rowHTML;
                        });
                    }
                });

            }
        });
        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('back-button'))
            {
                $('#dataTable2').hide();
                $('#dataTable1').show();

            }
        });
    }
}

class Stock{
    constructor() 
    {
        this.initializeTabs();
        this.category();
    }
    initializeTabs()
    {
        const vm=this;
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                stock:'stock',
            },
            dataType:'json',
            success: function (response) 
            {
                const tbodyElement = document.getElementById('itemTableBoady');
                tbodyElement.innerHTML = '';
                response.forEach((item,index)=> 
                {
                    const rowHTML = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.category}</td>
                                        <td>${item.brand} - ${item.product} - ${item.flavor}</td>
                                        <td>${item.unit}</td>
                                        <td>${item.total_qty}</td>
                                        <td>${item.item_code}</td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
        
        const tabElements = document.querySelectorAll('.cat');
        tabElements.forEach(tabName => {
            tabName.addEventListener('click', () => {
                tabElements.forEach(tab => {
                    tab.classList.remove('active');
                });
                tabName.classList.add('active');
                if(tabName.id=='viewExpiry')
                {   
                    $('#stockQty').hide();
                    $('#stockByCodeData').hide();
                    $('#allStockData').hide();
                    $('#stockExpiry').show();
                    vm.viewExpiryRecord();
                }else if(tabName.id=='stockbox')
                {
                    $('#stockExpiry').hide();
                    $('#stockByCodeData').hide();
                    $('#allStockData').hide();
                    $('#stockQty').show();
                }else if(tabName.id=='stockbyCode')
                {
                    $('#stockQty').hide();
                    $('#stockExpiry').hide();
                    $('#allStockData').hide();
                    $('#stockByCodeData').show();
                    vm.ItemCodeRecord();

                }else if(tabName.id=='allStock')
                {
                    $('#stockQty').hide();
                    $('#stockExpiry').hide();
                    $('#stockByCodeData').hide();
                    $('#allStockData').show();
                    vm.allStock();
                }
            });
        });
    }
    category()
    {
        $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                purchase: 'category'
            },
            success: function (response) 
            {
                var data = JSON.parse(response);
                var dropdownElement = $('#categoryFilter');
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));
                    $.each(data, function (index, item) 
                    {
                        dropdownElement.append($('<option>').text(item.category).val(item.category));
                    });
            }
        });

        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategory = this.value;
            if (selectedCategory === '') 
            {
                $('#itemTableBoady tr').show();
            }else 
            {
                $('#itemTableBoady tr').hide();
                $('#itemTableBoady tr').each(function() 
                {
                    if ($(this).find('td:nth-child(2)').text() == selectedCategory) 
                    {
                        $(this).show();
                    }
                });
            }
        });
    }
    viewExpiryRecord()
    {
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                expiry:'expiry',
            },
            dataType:'json',
            success: function (response) 
            {
                const tbodyElement = document.getElementById('expiryTable');
                tbodyElement.innerHTML = '';
                response.forEach((item,index)=> 
                {
                    const rowHTML = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor}</td>
                                        <td>${item.unit}</td>
                                        <td>${item.qty}</td>
                                        <td>${item.item_code}</td>
                                        <td>${item.exp}</td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
    }
    ItemCodeRecord()
    {
        // let log= $.ajax({
        //     url: 'ajax/fetch_master.php',
        //     type: 'GET',
        //     data: {
        //         codeData:'codeData',
        //     },
        //     dataType:'json',
        //     success: function (response) 
        //     {
        //         const tbodyElement = document.getElementById('itemCodeBoady');
        //         tbodyElement.innerHTML = '';
        //         response.forEach((item,index)=> 
        //         {
        //             const rowHTML = `<tr>
        //                                 <td>${index + 1}</td>
        //                                 <td>${item.category}</td>
        //                                 <td>${item.brand} - ${item.product}</td>
        //                                 <td>${item.total_qty}</td>
        //                                 <td>${item.item_code}</td>
        //                             </tr>`;
        //                 tbodyElement.innerHTML += rowHTML;
        //         });
        //     }
        // });
        const search_byCode = document.getElementById('search_byCode');
        search_byCode.addEventListener('click',function(e)
        {
            var itemcode=$('#itemcode').val();
            let log= $.ajax({
                url: 'ajax/fetch_master.php',
                type: 'GET',
                data: {
                    codeData:itemcode,
                },
                dataType:'json',
                success: function (response) 
                {
                    const tbodyElement = document.getElementById('itemCodeBoady');
                    tbodyElement.innerHTML = '';
                    response.forEach((item,index)=> 
                    {
                        const rowHTML = `<tr>
                                            <td>${index + 1}</td>
                                            <td>${item.category}</td>
                                            <td>${item.brand} - ${item.product}</td>
                                            <td>${item.flavor}</td>
                                            <td>${item.unitQty}-${item.unit}</td>
                                            <td>${item.qty}</td>
                                            <td>${item.item_code}</td>
                                        </tr>`;
                            tbodyElement.innerHTML += rowHTML;
                    });
                }
            });
            console.log(log);
        });
        
    }
    allStock()
    {
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                allStock:'stock',
            },
            dataType:'json',
            success: function (response) 
            {
                const tbodyElement = document.getElementById('allStockDataItems');
                tbodyElement.innerHTML = '';
                response.forEach((item,index)=> 
                {
                    const rowHTML = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.category}</td>
                                        <td>${item.brand} - ${item.product} - ${item.flavor}</td>
                                        <td>${item.unitQty}-${item.unit}</td>
                                        <td>${item.location}</td>
                                        <td>${item.baseprice}</td>
                                        <td>${item.gstprice}</td>
                                        <td>${item.saleprice}</td>
                                        <td>${item.qty}</td>
                                        <td>${item.item_code}</td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
    }
}

class Invoice
{
    constructor()
    {
        this.ids = [
            { id: 'category', purchase: 'category' },
            { id: 'flavor', purchase: 'flavor' },
        ];
        this.initializeTabs();
    }
    initializeTabs()
    {
        const vm=this;
        this.ids.forEach(idss =>{
            $.ajax({
                url:'ajax/fetch_master.php',
                type :'POST',
                dataType:'json',
                data:{InvoiceCate:'category',sell: idss.purchase},
                success: function(response)
                {
                    // var dropdownElement = $('#category');
                    // dropdownElement.empty();
                    // dropdownElement.append($('<option>').text('Select').val(''));
                    // $.each(response, function (index, item) 
                    // {
                    //     dropdownElement.append($('<option>').text(item.category).val(item.category));
                    // });

                    var dropdownElement = $('#' + idss.purchase);
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));
                    $.each(response, function (index, item) 
                    {
                        if(idss.id=='category')
                        {
                            dropdownElement.append($('<option>').text(item.category).val(item.category));
                        }else if(idss.id=='flavor')
                        {
                            dropdownElement.append($('<option>').text(item.flavor).val(item.flavor));
                        }
                    });
                }
            });
        });

        const tabElements = document.querySelectorAll('.cat');
        tabElements.forEach(tabName => {
            tabName.addEventListener('click', () => {
                tabElements.forEach(tab => {
                    tab.classList.remove('active');
                });
                tabName.classList.add('active');
                if(tabName.id=='viewInv')
                {   
                    $('#addsellData').hide();
                    $('#viewsellData').show();
                    vm.viewInvoiceRecord(0);
                }else if(tabName.id=='addSell')
                {
                    $('#viewsellData').hide();
                    $('#addsellData').show();
                }
            });
        });

        const search=document.getElementById('search');
        search.addEventListener('click',() => {
            vm.viewInvoiceRecord(1);
        });

        const refresh=document.getElementById('refresh');
        refresh.addEventListener('click',() => {
            vm.viewInvoiceRecord(0);
        });

        //below table datafetch Data;
        vm.fetchItems();

        const itemCode=document.getElementById('item_code');
        itemCode.addEventListener('input',function(event)
        {
            let selectedValue = event.target.value;
            const itemCode_Id = event.target.id;
            if(!selectedValue)return;

            let log=$.ajax({
                url:'ajax/fetch_master.php',
                type :'POST',
                dataType:'json',
                data:{sellMaster:selectedValue},
                success: function(response)
                {
                    $('#indeseRows').empty();
                    var dropdownElements = [
                        $('#brand'),$('#product')
                    ];
                    if (response.length === 0)
                    {
                        for(var i=0;i<dropdownElements.length;i++)
                        {
                            var dropdownElement=dropdownElements[i];
                            dropdownElement.empty();
                            dropdownElement.append($('<option>').text('Select').val(''));
                        }
                        return;
                    }

                    for(var i=0;i<dropdownElements.length;i++)
                    {
                        var dropdownElement=dropdownElements[i];
                        dropdownElement.empty();
                        var checkDuplicate = {};
                        $.each(response, function (index, item)
                        {
                            if(i==0)
                            {
                                if (!checkDuplicate[item.brand])
                                {
                                    checkDuplicate[item.brand] = true;
                                    dropdownElement.append($('<option>').text(item.brand).val(item.brand));
                                }
                            }else if(i==1)
                            {
                                if (!checkDuplicate[item.product]) 
                                {
                                    checkDuplicate[item.product] = true;
                                    dropdownElement.append($('<option>').text(item.product).val(item.product));
                                }
                            }
                            // else if(i==2)
                            // {
                            //     if (!checkDuplicate[item.flavor]) 
                            //     {
                            //         checkDuplicate[item.flavor] = true;
                            //         dropdownElement.append($('<option>').text(item.flavor).val(item.flavor));
                            //     }
                            // }
                            // else if(i==3)
                            // {
                            //     if (!checkDuplicate[item.unit]) 
                            //     {
                            //         checkDuplicate[item.unit] = true;
                            //         dropdownElement.append($('<option>').text(item.unit).val(item.unit));
                            //     }
                            // }
                        });
                    }
                    var insideSell='';
                    response.forEach((item,index)=> 
                    {
                        $('#category').val(item.category);
                        //  insideSell=`<div class="row"> <div class="col-md-2">
                        //             <label for="cate">Location</label>
                        //             <input type="text" class="form-control" id="location" placeholder="location..." readonly value="${item.location}">
                        //             <input type="hidden" class="id" id="id" value="${item.id}">
                        //             <input type="hidden" class="basepur" id="basepur" value="${item.baseprice}">
                        //         </div>
                        //         <div class="col-md-2">
                        //             <label for="cate">Expiry</label>
                        //             <input type="date" class="form-control expDate" id="expDate" readonly value="${item.exp}">
                        //         </div>
                        //         <div class="col-md-1">
                        //             <label for="cate">GST %</label>
                        //             <input type="text" class="form-control gst" id="gst" readonly value="${item.gst}">
                        //         </div>
                        //         <div class="col-md-1">
                        //             <label for="cate">QTY</label>
                        //             <input type="text" class="form-control qty" id="qty" readonly value="${item.qty}">
                        //         </div>
                        //         <div class="col-md-1">
                        //             <label for="cate">MRP</label>
                        //             <input type="text" class="form-control mrpPrice" id="mrpPrice" readonly value="${item.mrpprice}">
                        //         </div>
                        //         <div class="col-md-2">
                        //             <label for="cate">Sale</label>
                        //             <input type="text" class="form-control salePrice" id="salePrice" value="${item.saleprice}">
                        //         </div>
                        //         <div class="col-md-1">
                        //             <label for="cate">Sale Qty</label>
                        //             <input type="text" class="form-control saleqty" id="saleqty">
                        //         </div>
                        //         <div class="col-md-2">
                        //             <label for="cate">Total</label>
                        //             <input type="text" class="form-control total" id="total" readonly>
                        //         </div>
                        //         </div>`;
                        //     $('#indeseRows').append(insideSell);
                    });
                }
            });
        });


        //onchange
        const categories = document.querySelectorAll('#category, #brand, #product, #flavor, #unit, #unitQty');
        categories.forEach(category => {
            category.addEventListener('change', function(event) 
            {
                let selectedValue = event.target.value;
                const selectId = event.target.id;
                if(!selectedValue)return;
                $('#indeseRows').empty();
                vm.fetchDatas(selectedValue, selectId);
            });
        });

        //add to sell
        const sell = document.getElementById('addPurchaseItem');
        sell.addEventListener('click',function(event)
        {
            var input=['#item_code','#category','#brand','#product','#flavor','#unit','#unitQty'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }
            let category=$('#category').val();
            let brand=$('#brand').val();
            let product=$('#product').val();
            let flavor=$('#flavor').val();
            let unit=$('#unit').val();
            let item_code=$('#item_code').val();
            let unitQty=$('#unitQty').val();
            const rowContainers = $('#indeseRows .row');
            const saleItems = [];
            if(rowContainers.length > 0) 
            {
                rowContainers.each(function(index, row) 
                {
                    
                    const stockid = $(row).find('#id').val();
                    const location = $(row).find('#location').val();
                    const expDate = $(row).find('#expDate').val();
                    let gst = $(row).find('#gst').val();
                    let qty = $(row).find('#qty').val();
                    const salePrice = $(row).find('#salePrice').val();
                    let mrpPrice = $(row).find('#mrpPrice').val();
                    const saleQty = $(row).find('#saleqty').val();
                    let total = $(row).find('#total').val();
                    let basepur = $(row).find('#basepur').val();
                    // console.log(location, expDate, gst, qty, salePrice, mrpPrice, saleQty);
                    let Qtyto = $(row).find('#saleqty').val();
                    
                    if (Qtyto !== "" && parseFloat(Qtyto) !== 0)
                    {
                        total=parseFloat(total);
                        gst=parseFloat(gst);
                        mrpPrice=parseFloat(mrpPrice);
                        let saleQty1=parseFloat(saleQty);
                        qty=parseFloat(qty);

                        let gstmain=(gst/100)+1;
                        let BAseAmount=total/gstmain;
                        let gstAmount=total-BAseAmount;
                        let perItem=BAseAmount/saleQty1;

                        const newItem = 
                        {
                            category:category,
                            brand:brand,
                            product:product,
                            flavor:flavor,
                            unit:unit,
                            stockid: stockid,
                            gst: gst,
                            saleQty: saleQty1,
                            perItem: perItem.toFixed(2),
                            BAseAmount:BAseAmount.toFixed(2),
                            gstAmount:gstAmount.toFixed(2),
                            mrpPrice:mrpPrice.toFixed(2),
                            total:total.toFixed(2),
                            oldqty:qty,
                            basepur:basepur,
                            item_code:item_code,
                            unitQty:unitQty
                        };

                        const existingSaleItems = JSON.parse(localStorage.getItem('saleItems')) || [];
                        console.log('Existing Sale Items:', existingSaleItems);
                    
                        const itemAlreadyExists = existingSaleItems.some(item => item.stockid === stockid);
                        if (itemAlreadyExists) 
                        {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Item Already Added!',
                            })
                            return;
                        }else
                        {
                            saleItems.push(newItem);
                        }
                    }
                });

                const existingSaleItems = JSON.parse(localStorage.getItem('saleItems')) || [];
                existingSaleItems.push(...saleItems);
                if(existingSaleItems.length > 0) 
                {

                    localStorage.setItem('saleItems', JSON.stringify(existingSaleItems));
                    console.log(saleItems);
                    vm.fetchItems();
                }

                for(var i=0; i<input.length; i++)
                {
                    $(input[i]).val('');
                }
                $('#indeseRows').empty();
            }else 
            {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something Went Wrong!',
                })
                return;
            }
        });

        //do not take saleqty more that stock qty and multiply saleqty in into sale price
        $(document).on('input', '.saleqty', function() 
        {
            var saleInput = $(this);
            var saleQty = parseFloat(saleInput.val());
            var parentRow = saleInput.closest('.row');
            var availableQty = parseFloat(parentRow.find('.qty').val());
            var salePrice = parseFloat(parentRow.find('.salePrice').val());
            var totalInput = parentRow.find('.total');
        
            if (saleQty > availableQty) {
                saleInput.val(availableQty);
                saleQty = availableQty;
            }
        
            var total = saleQty * salePrice;
            totalInput.val(total);
        });

        //if saleprice change then change rate
        $(document).on('input','.salePrice', function()
        {
            var salePriceINPUT = $(this);
            var salePrice = parseFloat(salePriceINPUT.val());
            var parentRow=salePriceINPUT.closest('.row');
            var availableQty = parseFloat(parentRow.find('.qty').val());
            var totalInput = parentRow.find('.total');

            var total=salePrice * availableQty;
            totalInput.val(total);
        }); 


        //invoice button click
        const invoice=document.getElementById('submitinvoice');
        invoice.addEventListener('click',function(event)
        {
            vm.InvoiceData();
        });

        const cancelsell = document.getElementById('cancelsell');
        cancelsell.addEventListener('click', (event) => 
        {
            localStorage.removeItem('saleItems');
            const tableBody = document.getElementById('saleTableBoady');
            tableBody.innerHTML = '';
            $('#custName').val('');
            $('#custgst').val('');
            $('#custmobile').val('');
            $('#custadds').val('');
            $('#totalAmt').val('');
            $('#gstsel').val('');
            $('#pay').val('');
            vm.fetchItems();
        });
    }

    fetchDatas(selectedValue,select_Id)
    {
        let vm=this;
        var formData = new FormData();
        formData.append('id', select_Id);
        // $('#item_code').val('');
        if(select_Id == 'category')
        {
            formData.append('category', selectedValue);
        }else if (select_Id == 'brand')
        {
            var category= $('#category').val();
            formData.append('category', category);
            formData.append('brand', selectedValue);
        }else if(select_Id=='product')
        {
            var category= $('#category').val();
            var brand= $('#brand').val();
            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('product', selectedValue);

        }
        else if(select_Id=='flavor')
        {
            var category= $('#category').val();
            var brand= $('#brand').val();
            var product= $('#product').val();
            var item_code= $('#item_code').val();
            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('product', product);
            formData.append('flavor', selectedValue);
            formData.append('item_code', item_code);

            var input=['#category','#brand','#product','#flavor','#item_code'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }

        }else if(select_Id=='unit')
        {
            var category=$('#category').val();
            var brand=$('#brand').val();
            var product=$('#product').val();
            var flavor=$('#flavor').val();
            var item_code= $('#item_code').val();
            // var input=['#category','#brand','#product','#flavor','#unit'];
            // for(var i=0; i<input.length; i++)
            // {
            //     if($(input[i]).val() == '')
            //     {
            //         $(input[i]).css("border", "1px solid red");
            //         return;
            //     }else
            //     {
            //         $(input[i]).css("border","");
            //     }
            // }

            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('product', product);
            formData.append('flavor', flavor);
            formData.append('unit', selectedValue);
            formData.append('item_code', item_code);
        }
        else if(select_Id=='unitQty')
        {
            var category=$('#category').val();
            var brand=$('#brand').val();
            var product=$('#product').val();
            var flavor=$('#flavor').val();
            var item_code= $('#item_code').val();
            var unit= $('#unit').val();
            var input=['#category','#brand','#product','#flavor','#unit','#unitQty'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }

            formData.append('category', category);
            formData.append('brand', brand);
            formData.append('product', product);
            formData.append('flavor', flavor);
            formData.append('unit', unit);
            formData.append('unitQty', selectedValue);
            formData.append('item_code', item_code);
        }

        let log=$.ajax({
            url:'ajax/fetch_master.php',
            type :'POST',
            dataType:'json',
            data:formData,
            contentType: false,
            processData: false,
            success: function(response)
            {
                if(select_Id=='category')
                {
                    var dropdownElement= $('#brand');
                }
                else if(select_Id=='brand')
                {
                    var dropdownElement= $('#product');
                }
                else if(select_Id=='product')
                {
                    // var dropdownElement= $('#flavor');
                    var item_code=response[0].name;
                    $('#item_code').val(item_code);
                    return;
                }
                else if(select_Id=='flavor')
                {
                    var dropdownElement= $('#unit');
                }
                else if(select_Id=='unit')
                {
                    var dropdownElement= $('#unitQty');
                }
                else if(select_Id=='unitQty')
                {
                    // console.log(response);
                    // var item_code=response[0].name;
                    // $('#item_code').val(item_code);
                    vm.loadAdjuctData(response);
                    return;
                }
                dropdownElement.empty();
                dropdownElement.append($('<option>').text('Select').val(''));
                $.each(response, function (index, item)
                {
                    dropdownElement.append($('<option>').text(item.name).val(item.name));
                });
            }
        });
        // console.log(log);
    }
    loadAdjuctData(response)
    {
        console.log(response);
        // let log=$.ajax({
        //     url:'ajax/fetch_master.php',
        //     type :'POST',
        //     dataType:'json',
        //     data:{sellMaster:response},
        //     success: function(status)
        //     {
        //         $('#indeseRows').empty();
                var insideSell='';
                response.forEach((item,index)=>
                {
                        insideSell=`<div class="row"> <div class="col-md-2">
                                <label for="cate">Location</label>
                                <input type="text" class="form-control" id="location" placeholder="location..." readonly value="${item.location}">
                                <input type="hidden" class="id" id="id" value="${item.id}">
                                <input type="hidden" class="basepur" id="basepur" value="${item.baseprice}">
                            </div>
                            <div class="col-md-2">
                                <label for="cate">Expiry</label>
                                <input type="date" class="form-control expDate" id="expDate" readonly value="${item.exp}">
                            </div>
                            <div class="col-md-1">
                                <label for="cate">GST %</label>
                                <input type="text" class="form-control gst" id="gst" readonly value="${item.gst}">
                            </div>
                            <div class="col-md-1">
                                <label for="cate">QTY</label>
                                <input type="text" class="form-control qty" id="qty" readonly value="${item.qty}">
                            </div>
                            <div class="col-md-1">
                                <label for="cate">MRP</label>
                                <input type="text" class="form-control mrpPrice" id="mrpPrice" readonly value="${item.mrpprice}">
                            </div>
                            <div class="col-md-1">
                                <label for="cate">Sale</label>
                                <input type="text" class="form-control salePrice" id="salePrice" value="${item.saleprice}">
                            </div>
                            <div class="col-md-2">
                                <label for="cate">Sale QTY</label>
                                <input type="text" class="form-control saleqty" id="saleqty">
                            </div>
                            <div class="col-md-2">
                                    <label for="cate">Total</label>
                                    <input type="text" class="form-control total" id="total" readonly>
                                </div>
                            </div>`;
                            $('#indeseRows').append(insideSell);
                    });
        //     }
        // });
    }
    fetchItems()
    {
        const vm=this;
        const items = JSON.parse(localStorage.getItem('saleItems'));
        console.log(items);
        if (items !== null && Array.isArray(items))
        {
            const tableBody = document.getElementById('saleTableBoady');
            let totalAmount = 0;
            tableBody.innerHTML = '';
        
            items.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor} - ${item.unit} - ${item.unitQty}</td>
                    <td>${item.gst}</td>
                    <td>${item.saleQty}</td>
                    <td>${item.perItem}</td>
                    <td>${item.BAseAmount}</td>
                    <td>${item.gstAmount}</td>
                    <td>${item.total}</td>
                    <td><button class="btn btn-danger delete-button" data-index="${index}">Delete</button></td>
                `;
                tableBody.appendChild(row);
            });

            items.forEach(item => {
                totalAmount += parseFloat(item.total); // Assuming "mrp" is a numeric value
            });
            const totalAmt = document.getElementById('totalAmt').value=totalAmount;
        }

        //delete data in table;
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {
                const dataIndex = event.target.getAttribute('data-index');
                
                // Remove the item from items array
                items.splice(dataIndex, 1);
                
                // Update local storage
                localStorage.setItem('saleItems', JSON.stringify(items));
                
                // Re-render the table
                vm.fetchItems();
            }
        });
    }
    InvoiceData()
    {
        const vm=this;
        var input=['#custName','#saleDate','#totalAmt','#gstsel','#pay'];
        for(var i=0; i<input.length; i++)
        {
            if($(input[i]).val() == '')
            {
                $(input[i]).css("border", "1px solid red");
                return;
            }else
            {
                $(input[i]).css("border","");
            }
        }


        let custgst=$('#custgst').val();
        let custmobile=$('#custmobile').val();
        let custadds=$('#custadds').val();
        let custName=$('#custName').val();
        let saleDate=$('#saleDate').val();
        let totalAmt=$('#totalAmt').val();
        let gstsel=$('#gstsel').val();
        let pay=$('#pay').val();

        let items = JSON.parse(localStorage.getItem('saleItems'));

        let log=$.ajax({
            url:'ajax/submit_master.php',
            type:'post',
            dataType:'json',
            data:{
                custName:custName,
                saleDate:saleDate,
                totalAmt:totalAmt,
                saleitemList :items,
                gstsel:gstsel,
                pay:pay,
                custgst:custgst,
                custmobile:custmobile,
                custadds:custadds
            },
            success: function(response)
            {
                // console.log(response);
                // console.log(response.message);
                if(response.message=="Submited successfully..")
                {
                    localStorage.removeItem('saleItems');
                    const tableBody = document.getElementById('saleTableBoady');
                    tableBody.innerHTML = '';
                    vm.fetchItems();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Submited successfully..',
                    })

                    for(var i=0; i<input.length; i++)
                    {
                        $(input[i]).val('');
                    }
                    return;

                }else
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something Went Wrong!',
                    })
                    return;
                }
                
            }
        });
    }
    viewInvoiceRecord(sta)
    {
        // console.log(sta);
        if(sta==1)
        {
            var fromDate=$('#datefrom').val();
            var toDate=$('#dateto').val();
            var input=['#datefrom','#dateto'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }
        }else if(sta==0)
        {
            var fromDate='';
            var toDate='';
        }
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                invoiceRecord:'invoiceRecord',
                sta:sta,
                fromDate:fromDate,
                toDate:toDate,
            },
            dataType:'json',
            success: function (response) 
            {
                console.log(response);
                const tbodyElement = document.getElementById('viewSaleDataTable');
                tbodyElement.innerHTML = '';
                response.forEach(rowData => 
                {
                    const rowHTML = `<tr>
                                        <td>${rowData.id}</td>
                                        <td>${rowData.custName}</td>
                                        <td>${rowData.custGst}</td>
                                        <td>${rowData.custMobile}</td>
                                        <td>${rowData.custAdds}</td>
                                        <td>${rowData.date}</td>
                                        <td>${rowData.payMode}</td>
                                        <td>${rowData.totalAmt}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary view-button" data-id="${rowData.id}">VIEW</button>
                                        </td>
                                        <td>
                                        <button class="btn btn-sm btn-danger print-button" data-id="${rowData.id}">PRINT</button>
                                    </td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
        // console.log(log)

        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('view-button'))
            {
                $('#dataTable1').hide();
                $('#dataTable2').show();
                const row = event.target.closest('tr');
                let cat_id = row.querySelector('.view-button').getAttribute('data-id');
                let log= $.ajax({
                    url: 'ajax/fetch_master.php',
                    type: 'GET',
                    data: {
                        invoiceRecordItem:'invoiceRecordItem',
                        inv_id:cat_id,
                    },
                    dataType:'json',
                    success: function (response) 
                    {
                        const tbodyElement = document.getElementById('saleItems');
                        tbodyElement.innerHTML = '';
                        var totalAmount=0;
                        response.forEach((item,index)=> 
                        {
                            const rowHTML = `<tr>
                                                <td>${index + 1}</td>
                                                <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor} - ${item.unit}</td>
                                                <td>${item.gst}</td>
                                                <td>${item.qty}</td>
                                                <td>${item.rate}</td>
                                                <td>${item.amount}</td>
                                                <td>${item.sgst}</td>
                                                <td>${item.cgst}</td>
                                                <td>${item.igst}</td>
                                                <td>${item.totalAmount}</td>
                                            </tr>`;
                                tbodyElement.innerHTML += rowHTML;
                        });
                        response.forEach(item => {
                            totalAmount += parseFloat(item.totalAmount);
                        });
                        console.log(totalAmount);
                        const totalAmtElement = document.getElementById('totalSaleAmount');
                        totalAmtElement.textContent = `TOTAL AMOUNT - ${totalAmount}`;
                    }
                });

            }else if(event.target.classList.contains('print-button'))
            {
                const row = event.target.closest('tr');
                let cat_id = row.querySelector('.print-button').getAttribute('data-id');
                window.location="invoice.php?invoice_no="+cat_id;
            }
        });
        document.addEventListener('click', event => 
        {
            if(event.target.classList.contains('back-button'))
            {
                $('#dataTable2').hide();
                $('#dataTable1').show();

            }
        });
    }
}

class Profit
{
    fetchProfitTable()
    {
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                profit:'profit',
            },
            dataType:'json',
            success: function (response) 
            {
                console.log(response);
                const tbodyElement = document.getElementById('profitTable');
                tbodyElement.innerHTML = '';
                response.forEach((item,index)=> 
                {
                    const rowHTML = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.item_code}</td>
                                        <td>${item.product}</td>
                                        <td>${item.basePur.toFixed(2)}</td>
                                        <td>${item.baseSale.toFixed(2)}</td>
                                        <td>${item.profitPer.toFixed(2)}</td>
                                        <td>${item.qty}</td>
                                        <td>${item.totalPfofit.toFixed(2)}</td>
                                        <td>${item.date}</td>
                                        <td>${item.ivoice_id}</td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
        console.log(log)
    }
}

class FinalInvoice
{
    loadTableData() 
    {
        const vm=this;
        var currentUrl = new URL(window.location);
        var invoiceNo = currentUrl.searchParams.get("invoice_no");
        if (invoiceNo) 
        {
            let log= $.ajax({
                url: 'ajax/fetch_master.php',
                type: 'GET',
                data: {
                    invoiceNo:invoiceNo,
                },
                dataType:'json',
                success: function (response) 
                {
                    var custName = response[0].custName;
                    var custMobile = response[0].custMobile;
                    var custAdds = response[0].custAdds;
                    var custGst = response[0].custGst;
                    var payMode = response[0].payMode;
                    var date1 = response[0].date;

                    var nameSpan = document.getElementById("name");
                    var addsSpan = document.getElementById("adds");
                    var mobileSpan = document.getElementById("mobile");
                    var paySpan = document.getElementById("pay");
                    var gstSpan = document.getElementById("gst");
                    nameSpan.textContent = custName;
                    addsSpan.textContent = custAdds;
                    mobileSpan.textContent = custMobile;
                    gstSpan.textContent = custGst;
                    paySpan.textContent = payMode;

                    var inv = document.getElementById("inv");
                    var date = document.getElementById("date");
                    inv.textContent = invoiceNo;

                    date.textContent = date1;

                    let log= $.ajax({
                        url: 'ajax/fetch_master.php',
                        type: 'GET',
                        data: {
                            invoiceRecordItem:'invoiceRecordItem',
                            inv_id:invoiceNo,
                        },
                        dataType:'json',
                        success: function (response) 
                        {
                            console.log(response);
                            const tbodyElement = document.getElementById('tableDataInvoice');
                            tbodyElement.innerHTML = '';
                            var totalAmount=0;
                            response.forEach((item,index)=> 
                            {
                                const rowHTML = `<tr>
                                                    <td>${index + 1}</td>
                                                    <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor} - ${item.unitQty}</td>
                                                    <td>${item.gst}</td>
                                                    <td>${item.qty}</td>
                                                    <td>${item.rate}</td>
                                                    <td>${item.amount}</td>
                                                    <td>${item.sgst}</td>
                                                    <td>${item.cgst}</td>
                                                    <td>${item.igst}</td>
                                                    <td>${item.totalAmount}</td>
                                                </tr>`;
                                    tbodyElement.innerHTML += rowHTML;
                            });
                            response.forEach(item => {
                                totalAmount += parseFloat(item.totalAmount);
                            });
                            // console.log(totalAmount);
                            var words=vm.convertNumberToWords(totalAmount);
                            console.log(words)

                            const totalAmtElement = document.getElementById('totalAmt');
                            const inwords = document.getElementById('inwords');
                            totalAmtElement.textContent = `${totalAmount}`;
                            inwords.textContent = `IN WORDS:${words}`;
                            window.print();
                        }
                    });
    
                    
                }
            });
            window.onafterprint = function(event)
            {
                // window.location.href ="sell.php";
            };
        }else
        {
            console.log("Invoice number not found in the URL.");
        }
    }
    convertNumberToWords(number) 
    {
        const vm=this;
            var words = ["ZERO", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN",
                "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN"
            ];

            var tensWords = ["", "", "TWENTY", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY"];

            var wordsToReturn = "";
            var crore = Math.floor(number / 10000000);
            var lakh = Math.floor((number % 10000000) / 100000);
            var thousand = Math.floor((number % 100000) / 1000);
            var hundreds = Math.floor((number % 1000) / 100);
            var tens = Math.floor((number % 100) / 10);
            var ones = Math.floor(number % 10);

            if (crore > 0) {
                wordsToReturn += vm.convertNumberToWords(crore) + " CRORE ";
            }

            if (lakh > 0) {
                wordsToReturn += vm.convertNumberToWords(lakh) + " LAKH ";
            }

            if (thousand > 0) {
                wordsToReturn += vm.convertNumberToWords(thousand) + " THOUSAND ";
            }

            if (hundreds > 0) {
                wordsToReturn += words[hundreds] + " HUNDRED ";
            }

            if (tens > 0 || ones > 0) {
                if (tens < 2) {
                wordsToReturn += words[tens * 10 + ones] + " ";
                } else {
                wordsToReturn += tensWords[tens] + " ";
                if (ones > 0) {
                    wordsToReturn += words[ones] + " ";
                }
                }
            }

            return wordsToReturn.trim();
    }
}