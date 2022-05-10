<script type="text/javascript">
    var app = angular.module( '<?php echo $module;?>', []);
    app.controller('listController',function($scope, $http)
    {
        $scope.spinner = true;
        $scope.perPage = 20;
        $scope.totalRows = 0;
        $scope.pageStart = 1;
        $scope.pageEnd = 0;
        $scope.data = [];
        $scope.columns = [];
        $scope.maxPage = 0;
        $scope.is_search = false;
        $scope.disableTypeDate = true;
        $scope.disableTypeText = false;

        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        function myModal(val) {
            UIkit.modal.alert( val );
        }

        $scope.deleteClick = function(event) {
            var id_to_delete = $(event.target).parent().parent().find('li.delete-row').attr('data-id');
            UIkit.modal.confirm('Apakah anda yakin ingin menghapus ini?', function(){
                $scope.spinner = false;
                $http({
                    method: 'GET',
                    url: cms_url+"/delete/"+id_to_delete
                }).then(function successCallback(response) {
                    readTiket($scope.perPage);
                }, function errorCallback(response) {
                    UIkit.modal.alert('error '+response);
                });
            });
        };

        $scope.keydownClick = function(event){
            var target = event.target;
            var id = target.getAttribute('data-id');
            var value = target.value;
            $http({
                url: cms_url+"/update",
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: { id:id, value:value }
            }).then(function successCallback(response) {
                var result = response.data;
                if( result.status ){
                }else{
                    myModal( JSON.stringify(result) );
                }
            }, function errorCallback(response) {
                UIkit.modal.alert('error : '+ JSON.stringify(response));
            });
        };

        $scope.changeThemeClick = function (event) {
            var target = event.target;
            var theme = target.getAttribute('id');
            UIkit.modal.confirm('Apakah anda yakin ingin merubah tema?', function(){
                $scope.spinner = false;
                $http({
                    url: cms_url+"/update_theme",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: { value:theme }
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    var result = response.data;
                    if( result.status ){
                    }else{
                        myModal( JSON.stringify(response) );
                    }
                }, function errorCallback(response) {
                    UIkit.modal.alert('error : '+ JSON.stringify(response));
                });
            });
        };

        showBox();
    });

</script>