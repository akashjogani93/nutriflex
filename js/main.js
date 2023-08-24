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
        console.log(tabId)
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
                                            <th>EDIT/DELETE</th>
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
                    // console.log(slno,name,cat_id);
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
            // console.log(data);
            if (tabId === 'category') 
            {
                data.forEach(rowData => {
                    const rowHTML = `<tr>
                                        <td>${rowData.cat_id}</td>
                                        <td>${rowData.cateName}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.cat_id}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.cat_id}">Delete</button>
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
                                            <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
                                                <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
                                                <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
                                                <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
                                                <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
            console.log('Please Fill Feilds');
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
                // submitButton.disabled = false;
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
            { id: 'flavor', tabId: 'flavor' },
            { id: 'unit', tabId: 'unit' },
            { id: 'categoryFilter', tabId: 'category' },
        ];
    }
    
    fetchData()
    {
        this.dropdowns.forEach(dropdown =>{
            // console.log(dropdown.tabId)
            $.ajax({
                url: 'ajax/fetch_master.php',
                type: 'GET',
                data: {
                    tabId: dropdown.tabId
                },
                success: function (response) 
                {
                    // console.log(response);
                    var data = JSON.parse(response);
                    // console.log(data)
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
                        }else if(dropdown.id=='flavor')
                        {
                            dropdownElement.append($('<option>').text(item.flavorName).val(item.flavorName));
                        }else if(dropdown.id=='unit')
                        {
                            dropdownElement.append($('<option>').text(item.unitName).val(item.unitName));
                        }else if(dropdown.id=='categoryFilter')
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
            console.log(selectedCategory);
            if (selectedCategory === '') 
            {
                $('.table tr').show();
            }else 
            {
                $('.table tr').hide();
                $('.table tr').each(function() 
                {
                    // console.log($(this).find('td:nth-child(2)').text()== selectedCategory);
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
                const flavor = row.cells[4].textContent;
                const unit = row.cells[5].textContent;
                const item_code = row.cells[6].textContent;
                const cat_id = row.querySelector('.edit-button').getAttribute('data-id');
                // console.log(category,product);

                const rowData={
                    'slno':slno,
                    'category':category,
                    'brand':brand,
                    'product':product,
                    'flavor':flavor,
                    'unit':unit,
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
                                        <td>${rowData.flavor}</td>
                                        <td>${rowData.unit}</td>
                                        <td>${rowData.item_code}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-button" data-id="${rowData.id}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
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
        var flavor=$('#flavor').val();
        var product=$('#product').val();
        var unit=$('#unit').val();
        var item_code=$('#item_code').val();

        var feilds=['#category','#brand','#product','#flavor','#unit','#item_code'];
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
                    flavor:flavor,
                    product:product,
                    unni:unit,
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
        $('#flavor').val(rowData.flavor);
        $('#product').val(rowData.product);
        $('#unit').val(rowData.unit);
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
                                                <button class="btn btn-sm btn-danger delete-button" data-id="${rowData.id}">Delete</button>
                                            </td>
                                        </tr>`;
                            tbodyElement.innerHTML += rowHTML;
                    });
                }else if(check=='purchase')
                {
                    // console.log(response);
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
                    vm.viewPurchaseRecord();
                }else if(tabName.id=='addPur')
                {
                    $('#viewpurchaseData').hide();
                    $('#addPurchaseData').show();
                }
            });
        });

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
                            }
                        });
                }
            });
        });
        
        const selectElements = document.querySelectorAll('.onchange');
        selectElements.forEach(function (element) 
        {
            element.addEventListener('change', function (event)
            {
                const selectedValue = event.target.value;
                const categoryId = event.target.id;
                const status=0;
                if(!selectedValue){return;}
                vm.fetchAllData(selectedValue, categoryId,status);
            });
        });

        const item_code = document.getElementById('item_code');
        item_code.addEventListener('input',function (event)
        {
            const selectedValue = event.target.value;
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
    }

    fetchAllData(selectedValue, categoryId,status)
    {
        let log=$.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                purchase1: selectedValue,
                inputElement:categoryId
            },
            success: function (response1) 
            {
                var data1 = JSON.parse(response1);
                if(categoryId=='category')
                {
                    var dropdownElement = $('#brand');
                }else if(categoryId=='brand')
                {
                    var dropdownElement = $('#product');
                }else if(categoryId=='product')
                {
                    var dropdownElement = $('#flavor');
                }
                else if(categoryId=='flavor')
                {
                    var dropdownElement = $('#unit');
                } 
                
                if(categoryId !='unit' && categoryId !='item_code')
                {
                    dropdownElement.empty();
                    dropdownElement.append($('<option>').text('Select').val(''));
                }

                $.each(data1, function (index, item) 
                {
                    if(categoryId=='category')
                    {
                        dropdownElement.append($('<option>').text(item.brand).val(item.brand));
                    }
                    else if(categoryId=='brand')
                    {
                        dropdownElement.append($('<option>').text(item.product).val(item.product));
                    }else if(categoryId=='product')
                    {
                        dropdownElement.append($('<option>').text(item.flavor).val(item.flavor));
                    }else if(categoryId=='flavor')
                    {
                        dropdownElement.append($('<option>').text(item.unit).val(item.unit));
                    }
                    else if(categoryId=='unit')
                    {
                        $('#item_code').val(item.item_code);
                    }else if(categoryId=='item_code')
                    {
                        $('#category').val(item.category);
                        $('#brand').append($('<option>').text(item.brand).val(item.brand));
                        $('#product').append($('<option>').text(item.product).val(item.product));
                        $('#flavor').append($('<option>').text(item.flavor).val(item.flavor));
                        $('#unit').append($('<option>').text(item.unit).val(item.unit));
                        $('#brand').val(item.brand);
                        $('#product').val(item.product);
                        $('#flavor').val(item.flavor);
                        $('#unit').val(item.unit);
                    }
                });
            }
        });
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
        var input=['#category','#brand','#product','#flavor','#unit','#location','#expDate','#gst',,'#qty','#price','#mrpPrice','#salePrice',];
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
        };

        let existingItems = localStorage.getItem('items');
        let itemsArray = existingItems ? JSON.parse(existingItems) : [];
        let itemExists = itemsArray.some(item => item.item_code === item_code);

        if (!itemExists) {
            itemsArray.push(newItem);
            localStorage.setItem('items', JSON.stringify(itemsArray));
            this.fetchItems();
        } else {
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
                        <td>${item.unit}</td>
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

    deleteItem(index) {
        let items = JSON.parse(localStorage.getItem('items'));
        items.splice(index, 1);
        localStorage.setItem('items', JSON.stringify(items));
        this.fetchItems(); // Refresh the table after deletion
    }

    submitData()
    {
        const vm=this;
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
                        // showConfirmButton: false,
                        // timer: 1500
                      })
                    for(var i=0;i<input.length;i++)
                    {
                        if(i != 1)
                        {
                            $(input[i]).val('');
                        }
                    }
                    localStorage.removeItem('items');
                    vm.fetchItems();
                }else
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        // showConfirmButton: false,
                        // timer: 1500
                      })
                }
            }
        });
        console.log(log);
    }

    viewPurchaseRecord()
    {
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                purViewRecord:'purViewRecord',
            },
            dataType:'json',
            success: function (response) 
            {
                // console.log(response);

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
                // console.log(cat_id);
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
                        console.log(response);
        
                        const tbodyElement = document.getElementById('purchaseItems');
                        tbodyElement.innerHTML = '';
                        response.forEach((item,index)=> 
                        {
                            const rowHTML = `<tr>
                                                <td>${index + 1}</td>
                                                <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor}</td>
                                                <td>${item.unit}</td>
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
    }
    initializeTabs()
    {
        let log= $.ajax({
            url: 'ajax/fetch_master.php',
            type: 'GET',
            data: {
                stock:'stock',
            },
            dataType:'json',
            success: function (response) 
            {
                console.log(response);

                const tbodyElement = document.getElementById('itemTableBoady');
                tbodyElement.innerHTML = '';
                response.forEach((item,index)=> 
                {
                    const rowHTML = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.category} - ${item.brand} - ${item.product} - ${item.flavor}</td>
                                        <td>${item.unit}</td>
                                        <td>${item.total_qty}</td>
                                        <td>${item.item_code}</td>
                                    </tr>`;
                        tbodyElement.innerHTML += rowHTML;
                });
            }
        });
        console.log(log)
    }
}

class Invoice
{
    constructor()
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        $.ajax({
            url:'ajax/fetch_master.php',
            type :'POST',
            dataType:'json',
            data:{InvoiceCate:'category'},
            success: function(response)
            {
                console.log(response);
                var dropdownElement = $('#category');
                dropdownElement.empty();
                dropdownElement.append($('<option>').text('Select').val(''));
                $.each(response, function (index, item) 
                {
                    dropdownElement.append($('<option>').text(item.category).val(item.category));
                });
            }
        });

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
                    var dropdownElements = [
                        $('#brand'),$('#product'),$('#flavor'),$('#unit')
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
                            }else if(i==2)
                            {
                                if (!checkDuplicate[item.flavor]) 
                                {
                                    checkDuplicate[item.flavor] = true;
                                    dropdownElement.append($('<option>').text(item.flavor).val(item.flavor));
                                }
                            }
                            else if(i==3)
                            {
                                if (!checkDuplicate[item.unit]) 
                                {
                                    checkDuplicate[item.unit] = true;
                                    dropdownElement.append($('<option>').text(item.unit).val(item.unit));
                                }
                            }
                        });
                    }
                    var insideSell='';
                    response.forEach((item,index)=> 
                    {
                        $('#category').val(item.category);
                         insideSell=`<div class="row"> <div class="col-md-2">
                                    <label for="cate">Location</label>
                                    <input type="text" class="form-control" id="location" placeholder="location..." readonly value="${item.location}">
                                </div>
                                <div class="col-md-2">
                                    <label for="cate">Expiry Date</label>
                                    <input type="date" class="form-control" id="expDate" readonly value="${item.exp}">
                                </div>
                                <div class="col-md-2">
                                    <label for="cate">GST %</label>
                                    <input type="text" class="form-control" id="expDate" readonly value="${item.gst}">
                                </div>
                                <div class="col-md-2">
                                    <label for="cate">QTY</label>
                                    <input type="text" class="form-control" id="qty" readonly value="${item.qty}">
                                </div>
                                <div class="col-md-2">
                                    <label for="cate">Mrp Price</label>
                                    <input type="text" class="form-control" id="salePrice" readonly value="${item.mrpprice}">
                                </div>
                                <div class="col-md-2">
                                    <label for="cate">Sale Price</label>
                                    <input type="text" class="form-control" id="mrpPrice" readonly value="${item.saleprice}">
                                </div></div>`;
                            $('#indeseRows').append(insideSell);
                    });
                }
            });
        });
    }
}