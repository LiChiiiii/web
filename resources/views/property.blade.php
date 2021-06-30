@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'lost_property'
])


@section('content')
    <div class="content">
        <!-- lost property table --> 
        <div class="col-md-12">
            <div id="propertyTable" class="tabcontent">
                <div class="card">
                    <div class="card-header row justify-content-end  ">
                        <div class="col-4 text-center">
                        <h4 class="card-title">失物招領</h4>
                        </div>
                        <div class="col-4 text-right">
                        <button class="tablink btn btn-warning" style="margin-right:40px" onclick="openPage('addList', this)" >ADD NEW LIST</button>
                        </div>
                    </div>  
                    <div class="card-body">
                            <table id="propertyTable" class="table">
                                <thead class="text-primary ">
                                    <th>Property</th>
                                    <th>Location</th>
                                    <th>Image</th>
                                    <th>Upadate Time</th>
                                    <th>Status</th>
                                    <th class="text-center">Action
                                    <!-- <a href="#" class="tablink fas fa-plus-circle" onclick="openPage('addList', this)" ></a> -->
                                    </th>
                                    <th> </th>                              
                                </thead>
                                <tbody>
                                    @foreach(App\Models\lost_property::orderby('status','asc')->get() as $lost)
                                    <tr id="sid{{$lost->property_id}}">
                                        <td>{{ $lost-> property_name }}</td>
                                        <td>{{ $lost-> location }}</td>
                                        <td><img src="storage/{{$lost-> image}}"  width="180" height="180"/></td>  
                                        <td>{{ $lost-> 	updated_at }}</td>
                                        <td>{{ $lost-> status }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editProperty({{$lost->property_id}})" class="btn btn-primary">領取</a>
                                        </td>
                                        <td>
                                            <button type="button" class="close" aria-label="Close" href="javascript:void(0)" onclick="deleteProperty({{$lost->property_id}})">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
         <!--add list-->
         <div class="col-md-12">
            <div id="addList" class="tabcontent">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                        <h4 class="card-title">新增遺失物表單</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="propertyForm" method="POST" action="{{ route('property.create') }}" enctype="multipart/form-data">
                            @csrf   
                            <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                            <div class="form-group">
                                <label for="name">property Name</label>
                                <input type="text" class="form-control" id="name" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <textarea class="form-control" id="location" name="location" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option>尚未領取</option>
                                    <option>已領取</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">Image</label><br>
                                <button class="btn btn-dark">上傳照片
                                <input type="file" class="form-control" id="fule" name="file" onchange="previewFile(this)" style="width:95px"/>
                                </button><br>
                                <img id="previewImg" style="max-width:300px;margin-top:10px;"/>
                            </div>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>
                        <button class="tablink btn btn-danger pull-right" onclick="openPage('propertyTable', this)" id="defaultOpen">CANCEL</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
    function openPage(pageName,elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    document.getElementById(pageName).style.display = "block";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

@include('function.propertyTable')
@endsection

   