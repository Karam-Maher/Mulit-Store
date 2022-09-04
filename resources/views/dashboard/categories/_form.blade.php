<div class="form-group">
    <x-form.input label="Category Name" type="text" name="name" class="form-control" :value="$category->name" />
</div>

<div class="form-group">
    <label>Category Parent</label>
    <select name="parent_id" class="form-control @error('parent_id')is-invalid @enderror">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id, $category->parent_id') == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <x-form.textarea label="Description" name="description" :value="$category->description" />
</div>

<div class="form-group">
    <label>Status</label>
    <x-form.radio name="status" :checked="$category->status"
        :options="['active' => 'Active', 'archived' => 'Archived']" />
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" height="50">
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'Save' }}</button>
</div>
</form>
