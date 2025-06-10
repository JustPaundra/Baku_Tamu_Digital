<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Event;
use App\Models\Official;
use App\Models\Department;
use App\Models\GuestCategory;
use App\Models\Setting;
use Illuminate\Routing\Controller as BaseController;

class CrudManagementController extends BaseController
{
    public function __construct()
    {
        // Middleware untuk memastikan user sudah login sebagai admin
        $this->middleware(function ($request, $next) {
            if (!Session::get('is_admin')) {
                return redirect()->route('login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
            }
            return $next($request);
        });
    }

    // Dashboard CRUD Management
    public function index()
    {
        $stats = [
            'events' => Event::count(),
            'officials' => Official::count(),
            'departments' => Department::count(),
            'guest_categories' => GuestCategory::count(),
            'settings' => Setting::count(),
        ];

        return view('crud-management.index', compact('stats'));
    }

    // ========== EVENTS CRUD ==========
    public function eventsIndex()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('crud-management.events.index', compact('events'));
    }

    public function eventsCreate()
    {
        return view('crud-management.events.create');
    }

    public function eventsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Event::create($request->all());

        return redirect()->route('crud.events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    public function eventsEdit(Event $event)
    {
        return view('crud-management.events.edit', compact('event'));
    }

    public function eventsUpdate(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $event->update($request->all());

        return redirect()->route('crud.events.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    public function eventsDestroy(Event $event)
    {
        $event->delete();
        return redirect()->route('crud.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }

    // ========== OFFICIALS CRUD ==========
    public function officialsIndex()
    {
        $officials = Official::orderBy('name')->paginate(10);
        return view('crud-management.officials.index', compact('officials'));
    }

    public function officialsCreate()
    {
        $departments = Department::active()->orderBy('name')->get();
        return view('crud-management.officials.create', compact('departments'));
    }

    public function officialsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:50',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Official::create($request->all());

        return redirect()->route('crud.officials.index')
            ->with('success', 'Pejabat berhasil ditambahkan!');
    }

    public function officialsEdit(Official $official)
    {
        $departments = Department::active()->orderBy('name')->get();
        return view('crud-management.officials.edit', compact('official', 'departments'));
    }

    public function officialsUpdate(Request $request, Official $official)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:50',
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $official->update($request->all());

        return redirect()->route('crud.officials.index')
            ->with('success', 'Pejabat berhasil diperbarui!');
    }

    public function officialsDestroy(Official $official)
    {
        $official->delete();
        return redirect()->route('crud.officials.index')
            ->with('success', 'Pejabat berhasil dihapus!');
    }

    // ========== DEPARTMENTS CRUD ==========
    public function departmentsIndex()
    {
        $departments = Department::orderBy('name')->paginate(10);
        return view('crud-management.departments.index', compact('departments'));
    }

    public function departmentsCreate()
    {
        return view('crud-management.departments.create');
    }

    public function departmentsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'head_of_department' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Department::create($request->all());

        return redirect()->route('crud.departments.index')
            ->with('success', 'Departemen berhasil ditambahkan!');
    }

    public function departmentsEdit(Department $department)
    {
        return view('crud-management.departments.edit', compact('department'));
    }

    public function departmentsUpdate(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'head_of_department' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $department->update($request->all());

        return redirect()->route('crud.departments.index')
            ->with('success', 'Departemen berhasil diperbarui!');
    }

    public function departmentsDestroy(Department $department)
    {
        $department->delete();
        return redirect()->route('crud.departments.index')
            ->with('success', 'Departemen berhasil dihapus!');
    }

    // ========== GUEST CATEGORIES CRUD ==========
    public function guestCategoriesIndex()
    {
        $guestCategories = GuestCategory::orderBy('name')->paginate(10);
        return view('crud-management.guest-categories.index', compact('guestCategories'));
    }

    public function guestCategoriesCreate()
    {
        return view('crud-management.guest-categories.create');
    }

    public function guestCategoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'status' => 'required|in:active,inactive'
        ]);

        GuestCategory::create($request->all());

        return redirect()->route('crud.guest-categories.index')
            ->with('success', 'Kategori tamu berhasil ditambahkan!');
    }

    public function guestCategoriesEdit(GuestCategory $guestCategory)
    {
        return view('crud-management.guest-categories.edit', compact('guestCategory'));
    }

    public function guestCategoriesUpdate(Request $request, GuestCategory $guestCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'status' => 'required|in:active,inactive'
        ]);

        $guestCategory->update($request->all());

        return redirect()->route('crud.guest-categories.index')
            ->with('success', 'Kategori tamu berhasil diperbarui!');
    }

    public function guestCategoriesDestroy(GuestCategory $guestCategory)
    {
        $guestCategory->delete();
        return redirect()->route('crud.guest-categories.index')
            ->with('success', 'Kategori tamu berhasil dihapus!');
    }

    // ========== SETTINGS CRUD ==========
    public function settingsIndex()
    {
        $settings = Setting::orderBy('key')->paginate(10);
        return view('crud-management.settings.index', compact('settings'));
    }

    public function settingsCreate()
    {
        return view('crud-management.settings.create');
    }

    public function settingsStore(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,number,boolean,json',
            'description' => 'nullable|string'
        ]);

        Setting::create($request->all());

        return redirect()->route('crud.settings.index')
            ->with('success', 'Pengaturan berhasil ditambahkan!');
    }

    public function settingsEdit(Setting $setting)
    {
        return view('crud-management.settings.edit', compact('setting'));
    }

    public function settingsUpdate(Request $request, Setting $setting)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|in:text,number,boolean,json',
            'description' => 'nullable|string'
        ]);

        $setting->update($request->all());

        return redirect()->route('crud.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }

    public function settingsDestroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('crud.settings.index')
            ->with('success', 'Pengaturan berhasil dihapus!');
    }
}