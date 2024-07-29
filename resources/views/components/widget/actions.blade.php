<div class="btn-group">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ $linkfield ?? '' }}</a>

    <div class="dropdown-menu" style="">
        @isset($actions)
            @foreach ($actions as $action)
                @if (isset($action['route']))
                    @if ($action['route'] == 'divider')
                        <div class="dropdown-divider"></div>
                    @else
                        @php
                            $default = [
                                'show' => ['text' => 'Detalle', 'icon' => 'fas fa-eye'],
                                'edit' => ['text' => 'Editar', 'icon' => 'fas fa-pen'],
                                'destroy' => ['text' => 'Eliminar', 'icon' => 'fas fa-trash'],
                            ];
                            $method = substr($action['route'], strrpos($action['route'], '.') + 1);
                        @endphp

                        @can($action['route'])
                            @if ($method == 'destroy')
                                <form action="{{ route($action['route'], $id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn" type="submit"><i
                                            class="{{ $action['icon'] ?? $default[$method]['icon'] }} text-danger mr-2"></i>{{ $action['text'] ?? $default[$method]['text'] }}</button>
                                </form>
                            @else
                                <a href="{{ route($action['route'], $id) }}" class="dropdown-item"><i
                                        class="{{ $action['icon'] ?? ($default[$method]['icon'] ?? '') }} text-teal mr-2"></i>{{ $action['text'] ?? $default[$method]['text'] }}</a>
                            @endif
                        @endcan
                    @endif
                @endif
            @endforeach
        @endisset
    </div>

</div>
