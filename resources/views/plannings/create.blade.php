<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Planning - Lyon Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold">🏊‍♂️ Lyon Palme</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Nouveau Planning</h1>
                <p class="mt-2 text-sm text-gray-600">Créez un nouveau créneau d'entraînement</p>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form action="{{ route('plannings.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('date') border-red-300 @enderror">
                            @error('date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700">Jour de la semaine</label>
                            <select name="day" id="day" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('day') border-red-300 @enderror">
                                <option value="">Sélectionner un jour</option>
                                <option value="Lundi" {{ old('day') == 'Lundi' ? 'selected' : '' }}>Lundi</option>
                                <option value="Mardi" {{ old('day') == 'Mardi' ? 'selected' : '' }}>Mardi</option>
                                <option value="Mercredi" {{ old('day') == 'Mercredi' ? 'selected' : '' }}>Mercredi</option>
                                <option value="Jeudi" {{ old('day') == 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                                <option value="Vendredi" {{ old('day') == 'Vendredi' ? 'selected' : '' }}>Vendredi</option>
                                <option value="Samedi" {{ old('day') == 'Samedi' ? 'selected' : '' }}>Samedi</option>
                                <option value="Dimanche" {{ old('day') == 'Dimanche' ? 'selected' : '' }}>Dimanche</option>
                            </select>
                            @error('day')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Heure de début</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('start_time') border-red-300 @enderror">
                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Heure de fin</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('end_time') border-red-300 @enderror">
                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="coach1" class="block text-sm font-medium text-gray-700">Coach principal</label>
                            <input type="text" name="coach1" id="coach1" value="{{ old('coach1') }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('coach1') border-red-300 @enderror"
                                placeholder="Nom du coach principal">
                            @error('coach1')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="coach2" class="block text-sm font-medium text-gray-700">Coach assistant (optionnel)</label>
                            <input type="text" name="coach2" id="coach2" value="{{ old('coach2') }}" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Nom du coach assistant">
                        </div>
                    </div>

                    <div>
                        <label for="max_participants" class="block text-sm font-medium text-gray-700">Nombre maximum de participants</label>
                        <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants', 20) }}" 
                            min="1" max="50"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('max_participants') border-red-300 @enderror">
                        @error('max_participants')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description de l'entraînement</label>
                        <textarea name="description" id="description" rows="3" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Décrivez le type d'entraînement, les objectifs, etc.">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('plannings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Annuler
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Créer le planning
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
