<?php


namespace App\Http\Controllers;
use App\TodoItem;
use Illuminate\Http\Request;



class TodoItemsController extends Controller
{
    //private $sucess_status = 200;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
     public function index()
     {
     
       $todoItems = TodoItem::all();
       if(count($todoItems) > 0) {
        return response()->json(["status" => 200, "success" => true, "data" => $todoItems]);
    }

    else {
        return response()->json(["status" => 404, "success" => false, "data" => "Whoops! no todoItems found"]);
    }
      
     }

     public function create(Request $request)
     {
       $todoItem = new TodoItem;
       $todoItem->name= $request->name;
       $todoItem->description= $request->description;
       
       $todoItem->save();
       return response()->json(["status" => 200, "success" => true, "data" => $todoItem]);
     }

     public function show($id)
     {
        $todoItem = TodoItem::find($id);
        //return response()->json($todoItem);

        if(!is_null($todoItem)) {
            return response()->json(["status" => 200, "success" => true, "data" => $todoItem]);
        }

        else {
            return response()->json(["status" => 404, "success" => false, "data" => "Whoops! no todoItem found"]);
        }
     }

     public function update(Request $request, $id)
     { 
        $todoItem= TodoItem::find($id);

        if(!is_null($todoItem)) {

            $todoItem->name = $request->input('name');
            $todoItem->description = $request->input('description');
            $todoItem->save();
            return response()->json(["status" => 201, "success" => true, "data" => "Item updated successfully"]);
         }
        else 
        {
        return response()->json(["status" => 404, "success" => false, "data" => "Whoops! no todoItem found"]);
         }  
        
    }
     

     public function destroy($id)
     {
        $todoItem = TodoItem::find($id);
        if(!is_null($todoItem)) {
            $todoItem->delete();
        return response()->json(["status" => 204, "success" => true, "data" => "Item deleted successfully"]);
         }
        else 
        {
        return response()->json(["status" => 404, "success" => false, "message" => "Whoops! no todoItem found"]);
         }  
        
       
     }
   
}