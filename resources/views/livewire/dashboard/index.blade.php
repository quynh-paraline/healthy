
<div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{array_sum($data4)}}</h3>

                                <p>Orders New</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clock"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{array_sum($data2)}}</h3>

                                <p>Orders success</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-checkmark"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{array_sum($data3)}}</h3>

                                <p>Orders Returns</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-swap"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{array_sum($data1)}}</h3>

                                <p>Orders cancel</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-trash-a"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <h4 style="margin-bottom: 20px">Values of orders in this month : $<span style="color: green">{{$totalAll}}</span> </h4>
                        <canvas id="myChart" style="width:100%;max-height: 500px"></canvas>
                    </section>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const months = @json($months);
        const data1 = @json($data1);
        const data2 = @json($data2);
        const data3 = @json($data3);
        const data4 = @json($data4);
        const total1 = @json($total1);
        const total2 = @json($total2);
        const total3 = @json($total3);
        const total4 = @json($total4);


        new Chart("myChart", {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    data: data1,
                    label: 'Total $' + total1 + ' have order count ',
                    backgroundColor: "red",
                    borderColor: "red",
                    fill: false
                }, {
                    data: data2,
                    label: 'Total $' + total2 + ' have order count ',
                    backgroundColor: "green",
                    borderColor: "green",
                    fill: false
                }, {
                    data: data3,
                    label: 'Total $' + total3 + ' have order count ',
                    backgroundColor: "blue",
                    borderColor: "blue",
                    fill: false
                }, {
                    data: data4,
                    label: 'Total $' + total4 + ' have order count ',
                    backgroundColor: "orange",
                    borderColor: "orange",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    });
</script>
