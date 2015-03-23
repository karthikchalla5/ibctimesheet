jQuery(function () {

    $.ajax(
            {
                url: "get_employee_project_data_searchfilters.php",
                datatype: "json",
                success: function (data, textStatus, jqXHR)
                {
                    $("#employee_project_name").empty();
                    $('#employee_project_name').append($("<option></option>").val("").text("All"));

                    if (data.length != 0)
                    {
                        //alert(data);
                        $.each($.parseJSON(data), function (idx, obj)
                        {
                            $('#employee_project_name').append($("<option></option>").val(obj.project_id).text(obj.project_name));
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert("Unable to fetch data");
                }
            });

});