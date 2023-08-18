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
                                <label for="slno">SLNO</label>
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
                                            <th>Sl No</th>
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
            const data1=$(`#${tabId}-dataTable`).DataTable();

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
    }
    navigateToPage(pageUrl)
    {
        window.location.href = pageUrl;
    }
}

class ItemTab
{

}