import React from "react";
import Select from "react-select";

export default function Select2({
    options,
    onChange,
    placeholder,
    defaultOptions,
}) {
    // Custom Styles
    const customStyles = {
        control: (provided, state) => ({
            ...provided,
            borderColor: state.isFocused ? "#4CAF50" : "#ccc", // Warna border saat fokus
            boxShadow: state.isFocused
                ? "0 0 5px rgba(76, 175, 80, 0.5)"
                : "none",
            outline: "none", // Menghilangkan garis biru
            "&:hover": {
                borderColor: "#4CAF50", // Warna border saat hover
            },
        }),
    };

    return (
        <Select
            options={options}
            onChange={onChange}
            className="basic-multi-select"
            defaultValue={defaultOptions || null} // Set nilai default
            classNamePrefix="select"
            placeholder={placeholder || "Pilih opsi..."}
            isMulti // Aktifkan fitur multiple select
            styles={customStyles}
        />
    );
}
