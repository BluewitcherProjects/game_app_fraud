@if($show_task)


    <div class="transaction-section pb-15">

        <div class="section-header">
            <h2 class="text-center">Daily Tasks</h2>
        </div>


        @foreach($tasks as $task)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="card-title">{{ $task->title }}</div>

                    <div class="card-img" align="center">
                        <img src="{{ getImage(imagePath()['gateway']['path'] .'/'. $task->image) }}" width="200"
                             class="img-fluid">
                    </div>

                    <p align="center">
                        {!! nl2br($task->descr) !!}
                    </p>
                </div>

                <div class="card-footer" align="center">
                    <p>Share Now</p>
                    {!! Share::page($task->url, $task->title, ['class' => 'my-class', 'id' => $task->id])
            ->facebook()
            ->twitter()
            ->telegram()
            ->whatsapp() !!}
                </div>
            </div>
        @endforeach

    </div>

@endif