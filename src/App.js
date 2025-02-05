// Import Komponen
import { useState } from "react";
import Header from "./components/Header";
import TodoList from "./components/TodoList";

function App() {
    const [isRefresh, setIsRefresh] = useState(true);

    const setRefresh = (status) => {
        setIsRefresh(status);
    };

    return (
        <div className="App">
            <div className="content">
                {/* Memanggil komponen Header */}
                <Header setRefresh={setRefresh} />{" "}
                {/* Memanggil komponen TodoList */}
                <TodoList setRefresh={setRefresh} isRefresh={isRefresh} />{" "}
            </div>
        </div>
    );
}

export default App;
